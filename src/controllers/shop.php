<?php


$config = require ('config.php');
$db = new Database($config['database']);

$products = $db->query('SELECT * FROM product')->fetchAll();

$category = $db->query('SELECT * FROM category')->fetchAll();


require 'src/pages/shop.view.php';