<?php


// Connect to the database
$config = require('config.php');
$db = new Database($config['database']);


// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['delete-product-id'])) {

        $deleteProduct = $db->delete('product', [
            'product_id' => $_POST['delete-product-id']
        ]);


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
        $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
        $stock_level = filter_var($_POST['stock_level'], FILTER_VALIDATE_INT);
        $diameter = filter_var($_POST['diameter'], FILTER_VALIDATE_FLOAT);
        $height = filter_var($_POST['height'], FILTER_VALIDATE_FLOAT);
        $weight = filter_var($_POST['weight'], FILTER_VALIDATE_FLOAT);
        $capacity = filter_var($_POST['capacity'], FILTER_VALIDATE_FLOAT);
        $selectedCategories = $_POST['categories'];
        $targetDir = "public/upload/product/";
        $fileName = basename($_FILES['image_url']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);


        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($fileType), $allowedTypes)) {
            // Move the uploaded file to the target directory
            if (!move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFilePath)) {
                echo "The file " . htmlspecialchars($fileName) . " has not been uploaded successfully.";
            }
        }

        $createProduct = $db->insert(
            'product',
            [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'stock_level' => $stock_level,
                'image_url' => $fileName
            ]
        );

        if ($createProduct) {

            $getID = $createProduct;

            $setDimension = $db->insert(
                'dimensions',
                [
                    'product_id' => $getID,
                    'diameter' => $diameter,
                    'height' => $height,
                    'weight' => $weight,
                    'capacity' => $capacity
                ]
            );

            foreach ($selectedCategories as $cat):

                $setCategory = $db->insert(
                    'product_category',
                    [
                        'product_id' => $getID,
                        'category_id' => $cat,
                    ]
                );
            endforeach;

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