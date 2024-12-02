<?php


use Core\Database;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);



// Initialization
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




// Querry
$products = $db->query($product_query, $selectedCategories)->fetchAll();

$category = $db->query('SELECT DISTINCT c.* FROM category c 
    JOIN product_category pc ON c.category_id = pc.category_id 
    JOIN product p ON p.product_id = pc.product_id 
    WHERE p.stock_level > 0;')->fetchAll();



// Load page
require 'src/pages/shop.view.php';