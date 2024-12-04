<?php


use Core\Database;

// Connect to the database
$config = require 'config.php';
$db = new Database($config['database']);


// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['delete-product-id'])) {

        $deleteProduct = $db->delete('product', [
            'product_id' => $_POST['delete-product-id']
        ]);


        if ($deleteProduct) {

            header("Location: /products?status=success");

            exit;

        } else {

            header("Location: /products?status=fail");

            exit;
        }

    }
}



// Fetch products
$getProducts = $db->query('SELECT * FROM product')->fetchAll();


require 'src/pages/seller/products.view.php';