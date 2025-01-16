<?php
initSession();

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
    $orderItems = $_SESSION['cart_data']['items'];


    try {

        $db->transaction(function ($db) use ($orderDetail, $orderItems) {

            $orderId = $db->generateUniqueOrderId();

            $db->insert(
                'orders',
                [
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
                ]
            );

            foreach ($orderItems as $item) {

                $db->insert(
                    'order_item',
                    [
                        'order_id' => $orderId,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'total_price' => $item['total_price']
                    ]
                );

            };

            $db->delete('cart_items', ['user_id' => $_SESSION['user_id']]);

        });

        unset($_SESSION['cart_data']);
        unset($_SESSION['checkout_token']);
        redirect('/payment');

    } catch (Exception $e) {


        $transactionError = "We're sorry, 
        but there seems to be an issue with creating the new pottery product. Please try again.";
        error_log("Product creation error: " . $e->getMessage());

        dd($e->getMessage());


        setFlashMessage(
            'status',
            $transactionError,
            'error'
        );

        redirect('/checkout');
    }

} else {
    dd($_SERVER);
    redirect('/checkout');

}
