<?php


// Connect database
$config = require('config.php');
$db = new Database($config['database']);



// Querry
$promotion = $db->query('SELECT * FROM promotion')->fetchAll();

$collection = $db->query('SELECT * FROM product WHERE product_id = 2')->fetch();

$new_product = $db->query('SELECT * FROM product ORDER BY product_id DESC LIMIT 7;')->fetchAll();

$category = $db->query('SELECT DISTINCT c.* FROM category c 
    JOIN product_category pc ON c.category_id = pc.category_id 
    JOIN product p ON p.product_id = pc.product_id 
    WHERE p.stock_level > 0;')->fetchAll();



// Load page
require 'src/pages/home.view.php';