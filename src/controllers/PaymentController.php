<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Exception;

class PaymentController extends Controller
{
    protected AuthMiddleware $authMiddleware;
    protected ?string $orderId;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();
        $this->authMiddleware->authenticate('customer');

        $this->orderId = $_GET['order'] ?? null;

        try {

            $this->validateOrderAccess();

        } catch (Exception $e) {

            error_log("Payment access validation failed: " . $e->getMessage());

            $this->handleError();
        }
    }

    public function index()
    {
        try {

            $orderDetails = $this->fetchOrderDetails();

            echo $this->view('payment', [
                'orderDetails' => $orderDetails['order_id']
            ]);

        } catch (Exception $e) {

            $this->handleError();

        }
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/');
        }

        try {

            $this->validateOrderStatus();

            $this->processPayment();

            redirect("/order/detail/{$this->orderId}");

        } catch (Exception $e) {

            $message = "We're sorry, but there was an error processing your payment. Please try again.";
            $redirect = "/payment?order=" . urlencode($this->orderId);
            $this->handleProcessError($e, $redirect, $message);

        }
    }

    private function validateOrderAccess(): void
    {
        if (!$this->orderId) {

            throw new Exception('No order ID provided');

        }

        $order = $this->db->query(
            "SELECT user_id, order_status 
            FROM orders 
            WHERE order_id = :order_id",
            ['order_id' => $this->orderId]
        )->fetch();

        if (!$order) {

            throw new Exception('Order not found');

        }

        if ($order['user_id'] !== $_SESSION['user_id']) {

            throw new Exception('Unauthorized access to order');

        }

        if ($order['order_status'] === 'Paid') {

            redirect('/profile/orders');

        }
    }

    private function validateOrderStatus(): void
    {
        $order = $this->db->query(
            "SELECT order_status 
            FROM orders 
            WHERE order_id = :order_id 
            AND user_id = :user_id",
            [
                'order_id' => $this->orderId,
                'user_id' => $_SESSION['user_id']
            ]
        )->fetch();

        if (!$order) {
            throw new Exception('Order not found or unauthorized');
        }

        if ($order['order_status'] === 'Paid') {
            throw new Exception('Order already paid');
        }
    }

    private function fetchOrderDetails()
    {
        return $this->db->query(
            "SELECT o.*, 
                    u.firstname as customer_name,
                    u.email
            FROM orders o
            JOIN user u ON o.user_id = u.user_id
            WHERE o.order_id = :order_id 
            AND o.user_id = :user_id",
            [
                'order_id' => $this->orderId,
                'user_id' => $_SESSION['user_id']
            ]
        )->fetch();
    }

    private function processPayment(): void
    {
        $orderItems = $this->fetchOrderItems();

        $this->db->transaction(function ($db) use ($orderItems) {
            // Update order status
            $db->update(
                'orders',
                $this->orderId,
                ['order_status' => 'Paid'],
                'order_id'
            );

            // Update product stock levels
            foreach ($orderItems as $item) {
                $currentStock = $this->getCurrentStock($item['product_id']);
                $newStock = $currentStock - $item['quantity'];

                if ($newStock < 0) {
                    throw new Exception("Insufficient stock for product ID: {$item['product_id']}");
                }

                $db->update(
                    'product',
                    $item['product_id'],
                    ['stock_level' => $newStock],
                    'product_id'
                );
            }
        });

        $this->sendPaymentConfirmation();
    }

    private function fetchOrderItems(): array
    {
        return $this->db->query(
            "SELECT product_id, quantity 
            FROM order_item 
            WHERE order_id = :order_id",
            ['order_id' => $this->orderId]
        )->fetchAll();
    }

    private function getCurrentStock(int $productId): int
    {
        $result = $this->db->query(
            "SELECT stock_level 
            FROM product 
            WHERE product_id = :product_id",
            ['product_id' => $productId]
        )->fetch();

        if (!$result) {
            throw new Exception("Product not found: {$productId}");
        }

        return (int) $result['stock_level'];
    }

    private function sendPaymentConfirmation(): void
    {

        try {

            $orderDetails = $this->fetchOrderDetails();

            $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));

            $this->db->insert(
                'notifications',
                [
                    'user_id' => $_SESSION['user_id'],
                    'title' => 'Order Successful!',
                    'message' => "Thank you for your payment! Your order (ID: #{$this->orderId}) is now being processed. We’ll notify you once it’s shipped. 😊",
                    'category' => 'Order',
                    'created_at' => $dateTime->format('Y-m-d H:i:s')
                ]
                );

        } catch (Exception $e) {

            error_log("Failed to send payment confirmation email: " . $e->getMessage());
        }
    }

    private function handleError(): void
    {
        setFlashMessage(
            'status',
            'Unable to process payment. Please try again.',
            'error'
        );
        redirect('/cart');
    }
}