<?php

use Core\Database;
use Core\AuthService;


// Connect database
$config = require 'config.php';
$db = new Database($config['database']);
$auth = new AuthService;

$auth->checkLogin();
$auth->checkRole('customer');

if (!isset($_SESSION['csrf_token'])) {
    redirect('/cart');
}

$getCartItem = $db->query("SELECT 
    ci.quantity,
    p.name,
    p.stock_level,
    (p.price * ci.quantity) AS total_price
FROM 
    cart_items ci
JOIN 
    product p ON ci.product_id = p.product_id
WHERE
    user_id = :id", ['id' => $_SESSION['user_id']])->fetchAll();

$getCustomerDetail = $db->findOrFail('user', ['user_id' => $_SESSION['user_id']]);

$customerAddress = $db->query('SELECT *
FROM address
WHERE user_id = :user_id
AND is_default = TRUE;
', ['user_id' => $_SESSION['user_id']])->fetch();

require 'src/pages/checkout.view.php';
