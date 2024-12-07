<?php
session_start();

use Core\Database;

// Connect to the database
$config = require 'config.php';
$db = new Database($config['database']);

$selectedCategories = isset($_GET['categories']) ? array_map('intval', $_GET['categories']) : [];

$priceSort = isset($_GET['price_sort']) && in_array($_GET['price_sort'], ['low_high', 'high_low']) ? $_GET['price_sort'] : 'low_high';

$isChecked = false;

$product_query = "SELECT DISTINCT p.* FROM product p 
    JOIN product_category pc ON p.product_id = pc.product_id 
    WHERE p.stock_level > 0";

if (!empty($selectedCategories)) {

    $placeholders = implode(',', array_fill(0, count($selectedCategories), '?'));

    $product_query .= " AND pc.category_id IN ($placeholders)";
}

$product_query .= match ($priceSort) {
    'low_high' => " ORDER BY p.price ASC",
    'high_low' => " ORDER BY p.price DESC",
    default => "",
};


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
$getProducts = $db->query($product_query, $selectedCategories)->fetchAll();

$category = $db->query('SELECT DISTINCT c.* FROM category c 
    JOIN product_category pc ON c.category_id = pc.category_id 
    JOIN product p ON p.product_id = pc.product_id 
    WHERE p.stock_level > 0;')->fetchAll();

require 'src/pages/seller/products.view.php';