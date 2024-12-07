<?php


use Core\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    // Connect Database
    $config = require 'config.php';
    $db = new Database($config['database']);
    
    $email = $_GET['email'];
    $password = $_POST['password'];

    $getUser = $db->find('user', ['email' => $email]);

    if ($getUser && password_verify($password, $getUser['password'])) {

        // Password is correct, log the user in
        if($getUser['user_type'] === 2){

            redirect('/products');
            
        }
    } else {
        // Incorrect password
        echo "Invalid email or password.";
    }
}


require 'src/pages/verify.view.php';