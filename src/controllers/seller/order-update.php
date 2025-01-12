<?php

use Core\Database;
use Core\FormValidator;

// Connect to the database
$config = require 'config.php';
$db = new Database($config['database']);

// Initialize form validation
$validator = new FormValidator($_POST);

$validator
    ->minLength('trackingNumberInput', 1)
    ->required('trackingNumberInput');

// Check if validation passes
if ($validator->passes()) {

    $trackingData = $validator->getSanitizedData();

    try {

        $db->update(
            '`orders`',
            $trackingData['order_id'],
            [
                'tracking_number' => $trackingData['trackingNumberInput'],
                'order_status' => 'Shipped'
            ],
            'order_id'
        );

    } catch (Exception $e) {

        $error = "We're sorry, but there seems to be an issue with the database. Please try again.";
        error_log("Database update error: " . $e->getMessage());

        redirect('/404');

    }
} else {

    $getErrors = $validator->getErrors();

}

// Redirect to the review & rating page
redirect('/orders');