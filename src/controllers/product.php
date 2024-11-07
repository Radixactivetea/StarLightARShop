<?php


$config = require('config.php');
$db = new Database($config['database']);

$product = $db->query('SELECT * FROM product WHERE product_id = ' . $id)->fetch();
$products = $db->query('SELECT * FROM product ORDER BY RAND() LIMIT 4')->fetchAll();


require 'src/pages/product.view.php';