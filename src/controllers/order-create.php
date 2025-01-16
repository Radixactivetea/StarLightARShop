<?php

use Core\Database;
use Core\FormValidator;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);

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

    $orderDetail = $validator->getSanitizedData();

    try {

        $db->insert('orders', [
            'user_id' => $_SESSION['user_id'],
            'promotion_id' => '',
            'date' => $orderDetail['user_id'],
            'time' => $orderDetail['user_id'],
            'total_price' => $orderDetail['user_id'],
            'shipping_address' => $orderDetail['street_address'],
            'order_status' => 'Pending',
            'payment_method' => $orderDetail['payment']
        ]);
        
    }

} else {

    redirect('/checkout');

}
