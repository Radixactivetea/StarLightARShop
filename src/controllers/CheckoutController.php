<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\FormValidator;
use Exception;

class CheckoutController extends Controller
{
    protected AuthMiddleware $authMiddleware;
    protected string $token;
    protected string $sessionToken;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();
        $this->authMiddleware->handle('customer');

        $this->token = $_GET['token'] ?? '';
        $this->sessionToken = $_SESSION['checkout_token'] ?? '';

        try {

            $this->validateToken($this->token, $this->sessionToken);

        } catch (Exception $e) {

            error_log("Checkout token validation failed: " . $e->getMessage());

            $this->handleError();
        }
    }

    public function index()
    {
        $getCartItem = $this->fetchCartItems();
        $getCustomerDetail = $this->fetchCustomerDetail();
        $customerAddress = $this->fetchCustomerAddress();

        echo $this->view('checkout', [
            'getCartItem' => $getCartItem,
            'getCustomerDetail' => $getCustomerDetail,
            'customerAddress' => $customerAddress
        ]);
    }

    public function store()
    {
        $validator = new FormValidator($_POST);

        $validator
            ->required('payment')
            ->required('name')
            ->required('phone_number')
            ->required('street_address')
            ->required('state')
            ->required('city')
            ->required('post_code')
            ->numeric('post_code')
            ->required('total')
            ->numeric('total');

        if ($validator->passes()) {

            try {

                $this->processOrder($validator->getSanitizedData());

            } catch (Exception $e) {

                $this->handleOrderError($e);

            }
        } else {

            $this->handleValidationError();
        }
    }

    private function processOrder(array $orderDetail): void
    {
        $orderItems = $_SESSION['cart_data']['items'] ?? null;

        if (!$orderItems) {
            throw new Exception('No items in cart');
        }

        $orderId = $this->db->generateUniqueOrderId();

        $this->db->transaction(function ($db) use ($orderDetail, $orderItems, $orderId) {

            $this->createOrder($orderDetail, $orderId);

            $this->createOrderItems($orderItems, $orderId);

            $this->clearCart();
        });

        $this->cleanupCheckoutSession();
        redirect("/payment?order=" . urlencode($orderId));
    }

    private function createOrder(array $orderDetail, string $orderId): void
    {
        $this->db->insert('orders', [
            'order_id' => $orderId,
            'user_id' => $_SESSION['user_id'],
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'total_price' => $orderDetail['total'],
            'street_address' => $orderDetail['street_address'],
            'city' => $orderDetail['city'],
            'state' => $orderDetail['state'],
            'post_code' => $orderDetail['post_code'],
            'order_status' => 'Pending',
            'payment_method' => $orderDetail['payment']
        ]);
    }

    private function createOrderItems(array $items, string $orderId): void
    {
        foreach ($items as $item) {
            $this->db->insert('order_item', [
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_price' => $item['total_price']
            ]);
        }
    }

    private function fetchCartItems()
    {
        return $this->db->query(
            "SELECT ci.quantity, p.name, p.stock_level, (p.price * ci.quantity) AS total_price 
            FROM cart_items ci
            JOIN product p ON ci.product_id = p.product_id
            WHERE user_id = :id",
            ['id' => $_SESSION['user_id']]
        )->fetchAll();
    }

    private function fetchCustomerDetail()
    {
        return $this->db->findOrFail('user', ['user_id' => $_SESSION['user_id']]);
    }

    private function fetchCustomerAddress()
    {
        return $this->db->query(
            'SELECT *
            FROM address 
            WHERE user_id = :user_id
            AND is_default = TRUE;',
            ['user_id' => $_SESSION['user_id']]
        )->fetch();
    }

    private function validateToken($token, $sessionToken): void
    {
        if (empty($sessionToken) || !hash_equals($sessionToken, $token)) {
            redirect('/cart');
        }
    }

    private function clearCart(): void
    {
        $this->db->delete('cart_items', ['user_id' => $_SESSION['user_id']]);
    }

    private function cleanupCheckoutSession(): void
    {
        unset($_SESSION['cart_data']);
        unset($_SESSION['checkout_token']);
    }

    private function handleError(): void
    {
        unset($_SESSION['checkout_token']);
        redirect('/cart');
    }

    private function handleOrderError(Exception $e): void
    {
        error_log("Order creation error: " . $e->getMessage());

        setFlashMessage(
            'status',
            "We're sorry, but there was an issue processing your order. Please try again.",
            'error'
        );

        redirect('/checkout');
    }

    private function handleValidationError(): void
    {
        redirect('/checkout');
    }
}