<?php

use Core\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Connect Database
    $config = require 'config.php';
    $db = new Database($config['database']);

    // Check if email exists in the database
    $email = trim($_POST['email']);

    $getUser = $db->find('user', ['email' => $email]);
    
    if ($getUser){

        // Email exists, prompt for password
        header("Location: /password?email=$email");
        exit;
    } else {

        // Email doesn't exist, redirect to register page
        header("Location: /register?email=$email");
        exit;
    }
}

// Load page
require 'src/pages/login.view.php';