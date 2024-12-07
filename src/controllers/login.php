<?php

use Core\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Connect Database
    $config = require 'config.php';
    $db = new Database($config['database']);

    // Check if email exists in the database
    $email = trim($_POST['email']);

    $getUser = $db->find('user', ['email' => $email]);

    if ($getUser) {

        redirect("/verify?email={$email}");

    } else {

        redirect("/register?email={$email}");
        
    }
}

// Load page
require 'src/pages/login.view.php';