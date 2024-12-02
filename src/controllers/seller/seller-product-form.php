<?php


use Core\Database;

// Connect to the database
$config = require 'config.php';
$db = new Database($config['database']);


$selectedCategories = [];

$category = $db->query('SELECT * FROM category')->fetchAll();


require 'src/pages/seller/seller-product.form.php';