<?php


use Core\Database;

// Connect to the database
$config = require 'config.php';
$db = new Database($config['database']);


$selectedCategories = [];

$category = $db->query('SELECT * FROM category')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    dd($_POST);
}


require 'src/pages/seller/product-create.view.php';