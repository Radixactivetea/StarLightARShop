<?php

use Core\Database;
use Core\FormValidator;

// Connect to the database
$config = require 'config.php';
$db = new Database($config['database']);

// Initialize form validation
$validator = new FormValidator($_POST);

$validator
    ->minLength('replyReviewInput', 1)
    ->maxLength('replyReviewInput', 300)
    ->required('replyReviewInput');

// Check if validation passes
if ($validator->passes()) {
    
    $replyData = $_POST;

    try {

        $db->update(
            '`review&rating`',
            $replyData['review_id'],
            ['response' => $replyData['replyReviewInput']],
            'review_id'
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
redirect('/review&rating');