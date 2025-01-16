<?php

use Core\Database;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        $orderId = $_GET['order'];

        $db->transaction(function ($db) use ($orderId) {

            $db->update(
                'orders',
                $orderId,
                [
                    'order_status' => 'Paid'
                ],
                'order_id'
            );

        });

        redirect('/profile/orders');

    } catch (Exception $e) {


        $transactionError = "We're sorry. Please try again.";
        error_log("Error: " . $e->getMessage());

        dd($e->getMessage());
    }
}


require 'src/pages/payment.view.php';