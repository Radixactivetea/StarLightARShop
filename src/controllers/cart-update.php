<?php
initSession();

use Core\Database;

$config = require 'config.php';
$db = new Database($config['database']);

$quantity = (int) $_POST['quantity'];
$product_id = (int) $_POST['product_id'];

$db->query(
    "UPDATE cart_items SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id",
    [
        'quantity' => $quantity,
        'product_id' => $product_id,
        'user_id' => $_SESSION['user_id']
    ]
);

$getCartTotal = $db->query(
    "SELECT 
        SUM(p.price * ci.quantity) AS total_price
    FROM 
        cart_items ci
    JOIN 
        product p ON ci.product_id = p.product_id
    WHERE
        ci.user_id = :id;",
    ['id' => $_SESSION['user_id']]
)->fetch();


$subtotal = $getCartTotal['total_price'] ?? 0;
$tax = round($subtotal * 0.02, 2); // 2% tax
$shippingCost = 5; // Static shipping cost
$total = round($subtotal + $tax + $shippingCost, 2); // Ensure total is rounded to 2 decimal places

// Set the header for JSON response
header('Content-Type: application/json');

// Return the response as JSON
echo json_encode([
    'success' => true,
    'subtotal' => $subtotal,
    'tax' => $tax,
    'total' => $total
]);

exit;
