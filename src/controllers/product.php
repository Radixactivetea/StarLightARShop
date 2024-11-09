<?php


$config = require('config.php');
$db = new Database($config['database']);


$product = $db->query('SELECT * FROM product WHERE product_id = :id', ['id' => $id])->fetch();
$products = $db->query('SELECT * FROM product ORDER BY RAND() LIMIT 4')->fetchAll();
$dimensions = $db->query('SELECT * FROM dimensions WHERE product_id = :id', ['id' => $id])->fetchAll();


require 'src/pages/product.view.php';