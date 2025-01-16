<?php

use Core\Database;
use Core\AuthService;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);
$auth = new AuthService;

$auth->checkLogin();
$auth->checkRole('customer');



$checkItemExist = $db->find(
    'cart_items',
    [
        'user_id' => $_SESSION['user_id'],
        'product_id' => $_POST['product_id']
    ]
);

if (empty($checkItemExist)) {

    $db->insert(
        'cart_items',
        [
            'user_id' => $_SESSION['user_id'],
            'product_id' => $_POST['product_id'],
            'quantity' => $_POST['quantity']
        ]
    );

} else {

    $db->query('UPDATE `cart_items`
    SET `quantity` = :quantity
    WHERE `user_id` = :user_id AND `product_id` = :product_id;',
        [
            'quantity' => $_POST['quantity'],
            'user_id' => $_SESSION['user_id'],
            'product_id' => $_POST['product_id']
        ]
    );
}

redirect("/shop/{$_POST['product_id']}");
