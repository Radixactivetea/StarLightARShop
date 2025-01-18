<?php

namespace Src\Controllers;

use Core\AuthMiddleware;

class CartController extends Controller
{
    protected $authMiddleware;
    public $shippingCost = 5;
    public $tax;
    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->authMiddleware->authenticate('customer');
    }

    public function viewCart()
    {
        $cartItems = $this->fetchCartItems();
        $products = $this->fetchSuggestProduct();
        $cartTotal = $this->calculateCartTotal($cartItems);
        $totalPrice = $this->calculateTotalPrice($cartTotal);

        echo $this->view('cart', [
            'cartItems' => $cartItems,
            'products' => $products,
            'cartTotal' => $cartTotal,
            'totalPrice' => $totalPrice,
            'tax' => $this->tax,
            'shippingCost' => $this->shippingCost
        ]);
    }

    public function addToCart(int $productId)
    {
        $quantity = $_POST['quantity'];

        $checkItemExist = $this->db->find(
            'cart_items',
            [
                'user_id' => $_SESSION['user_id'],
                'product_id' => $productId
            ]
        );

        if (empty($checkItemExist)) {

            $this->addItemToCart($productId, $quantity);

        } else {

            $this->updateCartItemQuantity($productId, $quantity);

        }

        $this->redirect("/shop/{$productId}");
    }

    public function updateCart()
    {
        $quantity = (int) $_POST['quantity'];
        $productId = (int) $_POST['product_id'];

        $this->updateCartItemQuantity($productId, $quantity);

        $cartItems = $this->fetchCartItems();
        $cartTotal = $this->calculateCartTotal($cartItems);
        $totalPrice = $this->calculateTotalPrice($cartTotal);

        header('Content-Type: application/json');

        echo json_encode([
            'success' => true,
            'subtotal' => $cartTotal,
            'tax' => $this->tax,
            'total' => $totalPrice
        ]);
    }

    public function removeFromCart()
    {
        $productId = $_POST['product-id'] ?? '';
        // Logic to remove product from cart
        $this->db->query(
            'DELETE FROM cart_items WHERE user_id = :user_id AND product_id = :product_id',
            ['user_id' => $_SESSION['user_id'], 'product_id' => $productId]
        );

        $this->redirect('/cart');
    }

    public function moveToCheckOut()
    {
        $cartItems = $this->fetchCartItems();
        $cartTotal = $this->calculateCartTotal($cartItems);
        $totalPrice = $this->calculateTotalPrice($cartTotal);

        $this->storeCartDataInSession($cartItems, $cartTotal, $totalPrice);

        $this->redirect('/checkout?token=' . $_SESSION['checkout_token']);
    }

    private function storeCartDataInSession($cartItems, $totalCart, $totalPrice)
    {
        $cartItems = $this->fetchCartItems();
        $cartTotal = $this->calculateCartTotal($cartItems);
        $totalPrice = $this->calculateTotalPrice($cartTotal);

        $_SESSION['cart_data'] = [
            'items' => $cartItems,
            'subtotal' => number_format($totalCart, 2),
            'tax' => number_format($totalCart * 0.02, 2),
            'shipping' => number_format(5, 2),
            'total' => number_format($totalPrice, 2),
        ];

        if (empty($_SESSION['checkout_token'])) {
            $_SESSION['checkout_token'] = bin2hex(random_bytes(32));
        }
    }

    private function addItemToCart(int $productId, int $quantity)
    {
        $this->db->insert(
            'cart_items',
            [
                'user_id' => $_SESSION['user_id'],
                'product_id' => $productId,
                'quantity' => $quantity
            ]
        );
    }

    private function updateCartItemQuantity(int $productId, int $quantity)
    {
        $this->db->query('UPDATE `cart_items`
            SET `quantity` = :quantity
            WHERE `user_id` = :user_id AND `product_id` = :product_id;',
            [
                'quantity' => $quantity,
                'user_id' => $_SESSION['user_id'],
                'product_id' => $productId
            ]
        );
    }

    private function fetchCartItems()
    {
        return $this->db->query("
            SELECT ci.cart_id, ci.user_id, ci.product_id, ci.quantity, p.name, p.stock_level, p.price, p.image_url, 
                   (p.price * ci.quantity) AS total_price, GROUP_CONCAT(c.name SEPARATOR ', ') AS category
            FROM cart_items ci
            JOIN product p ON ci.product_id = p.product_id
            JOIN product_category pc ON p.product_id = pc.product_id
            JOIN category c ON pc.category_id = c.category_id
            WHERE user_id = :id
            GROUP BY ci.cart_id, ci.user_id, ci.product_id, ci.quantity, p.name, p.stock_level, p.price, p.image_url;
        ", ['id' => $_SESSION['user_id']])->fetchAll();
    }

    private function fetchSuggestProduct()
    {
        return $this->db->query('SELECT * FROM product ORDER BY RAND() LIMIT 4')->fetchAll();
    }

    private function calculateCartTotal($cartItems)
    {
        $totalPrice = 0;
        foreach ($cartItems as $item) {

            $totalPrice += $item['total_price'];
        }

        return $totalPrice;
    }

    private function calculateTotalPrice($totalCart)
    {
        $this->tax = $totalCart * 0.02;

        return $totalCart + $this->tax + $this->shippingCost;
    }
}
