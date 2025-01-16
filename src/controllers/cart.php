<?php
use Core\Database;
use Core\AuthService;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);

$auth = new AuthService;
$auth->checkLogin();
$auth->checkRole('customer');

// Fetch cart items
$getAllCartList = $db->query("SELECT 
    ci.cart_id,
    ci.user_id,
    ci.product_id,
    ci.quantity,
    p.name,
    p.stock_level,
    p.price,
    p.image_url,
    (p.price * ci.quantity) AS total_price,
    GROUP_CONCAT(c.name SEPARATOR ', ') AS category
FROM 
    cart_items ci
JOIN 
    product p ON ci.product_id = p.product_id
JOIN 
    product_category pc ON p.product_id = pc.product_id
JOIN 
    category c ON pc.category_id = c.category_id
WHERE
    user_id = :id
GROUP BY 
    ci.cart_id, ci.user_id, ci.product_id, ci.quantity, p.name, p.stock_level, p.price, p.image_url;",
    ['id' => $_SESSION['user_id']]
)->fetchAll();

// Calculate totals
$getCartTotal = $db->query("SELECT 
    SUM(p.price * ci.quantity) AS total_price
FROM 
    cart_items ci
JOIN 
    product p ON ci.product_id = p.product_id
WHERE
    ci.user_id = :id;",
    ['id' => $_SESSION['user_id']]
)->fetch();

$total_cart = $getCartTotal['total_price'];
$tax = $total_cart * 0.02;
$shippingCost = 5;
$total_price = $total_cart + $tax + $shippingCost;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Store cart data in session
    $_SESSION['cart_data'] = [
        'items' => $getAllCartList,
        'subtotal' => $total_cart,
        'tax' => $tax,
        'shipping' => $shippingCost,
        'total' => $total_price
    ];

    // Generate CSRF token
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    redirect('/checkout');
}

require 'src/pages/cart.view.php';
