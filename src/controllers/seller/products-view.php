<?php
session_start();

use Core\Database;

// Connect to the database
$config = require 'config.php';
$db = new Database($config['database']);


// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['delete-product-id'])) {

        $product = $db->find('product', ['product_id' => $_POST['delete-product-id']]);

        if ($product) {

            $imagePath = "public/upload/product/{$product['image_url']}";

            if (file_exists($imagePath)) {

                unlink($imagePath);

            }

            $deleteProduct = $db->delete('product', [
                'product_id' => $_POST['delete-product-id']
            ]);

            if ($deleteProduct) {

                setFlashMessage(
                    'status',
                    'Product deleted successfully',
                    'success'
                );

            } else {

                setFlashMessage(
                    'status',
                    'There is something wrong. Product not deleted!',
                    'error'
                );
            }
        }

        redirect('/manage/products');
    }
}



// Fetch products
$getProducts = $db->query('SELECT * FROM product')->fetchAll();


require 'src/pages/seller/products.view.php';