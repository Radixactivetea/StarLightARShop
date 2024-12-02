<?php

use Core\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Connect Database
    $config = require 'config.php';
    $db = new Database($config['database']);

    // Trim
    $email = trim($_GET['email']);
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $password = $_POST['password'];
    $dob_day = trim($_POST['dob_day']);
    $dob_month = trim($_POST['dob_month']);
    $dob_year = trim($_POST['dob_year']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into database
    $createNewUser = $db->insert('user', [
        'username' => $username,
        'full_name' => $fullname,
        'password' => $hashedPassword,
        'email' => $email
    ]);
}

// Load page
require 'src/pages/register.view.php';