<?php


// Connect to the database
$config = require('config.php');
$db = new Database($config['database']);



// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['delete-product-id'])) {

        $deleteProduct = $db->executeQuery(

            'DELETE FROM product WHERE product_id = :id',
            ['id' => $_POST['delete-product-id']]
        );

        if ($deleteProduct) {

            header("Location: /seller/manage-products?status=success");

            exit;

        } else {

            header("Location: /seller/manage-products?status=fail");

            exit;
        }

    } elseif (isset($_POST['save-form'])) {

        // Sanitize and validate input
        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $img_url = $_POST['image_url'];
        $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
        $stock_level = filter_var($_POST['stock_level'], FILTER_VALIDATE_INT);

        $createProduct = $db->executeQuery(
            'INSERT INTO `product` (`name`, `description`, `price`, `stock_level`, `image_url`) 
            VALUES (:name, :description, :price, :stock_level, :image_url)',
            [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'stock_level' => $stock_level,
                'image_url' => $img_url
            ]
        );

        if ($createProduct) {

            header("Location: /seller/manage-products?status=success");

            exit;

        } else {

            header("Location: /seller/manage-products?status=fail");

            exit;
        }
    }
}



// Fetch products
$getProducts = $db->query('SELECT * FROM product')->fetchAll();



require 'src/pages/seller/seller-products.view.php';