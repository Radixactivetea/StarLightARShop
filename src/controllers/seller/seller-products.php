<?php


// Connect database
$config = require('config.php');
$db = new Database($config['database']);



// Initialize



// Query
$getProducts = $db->query('SELECT * FROM product')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-product-id'])) {

    $deleteProduct = $db->executeQuery('DELETE FROM product WHERE product_id = :id', ['id' => $_POST['delete-product-id']]);

    if ($deleteProduct) {

        header("Location: /seller/manage-products?delete=success");
        
        exit;

    } else {

        header("Location: /seller/manage-products?delete=error");

        exit;
    }
}


require 'src/pages/seller/seller-products.view.php';