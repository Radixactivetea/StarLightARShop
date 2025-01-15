<?php

use Core\Database;
use Core\AuthService;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);

$auth = new AuthService;

// FOR TESTING
$auth->login('userthree', 'Userthree123');

$auth->checkLogin();
$auth->checkRole('customer');

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
    ci.cart_id, ci.user_id, ci.product_id, ci.quantity, p.name, p.stock_level, p.price, p.image_url;", ['id' => $_SESSION['user_id']])->fetchAll();


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

// Calculate the 2% tax
$tax = $total_cart * 0.02;

$shippingCost = 5;

$total_price = $total_cart + $tax + $shippingCost;




require 'src/pages/cart.view.php';