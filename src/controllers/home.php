<?php


use Core\Database;

// Connect database
$config = require('config.php');
$db = new Database($config['database']);



// Querry
$promotion = $db->findAll('promotion');

$collection = $db->find('product', ['product_id' => 2]);

$new_product = $db->findAll('product', [], [
    'orderBy' => 'product_id DESC',
    'limit' => 7
]);

$category = $db->query('SELECT DISTINCT c.* FROM category c 
    JOIN product_category pc ON c.category_id = pc.category_id 
    JOIN product p ON p.product_id = pc.product_id 
    WHERE p.stock_level > 0;'
)->fetchAll();



// Load page
require 'src/pages/home.view.php';