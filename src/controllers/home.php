<?php


$config = require('config.php');
$db = new Database($config['database']);

$promotion = $db->query('SELECT * FROM promotion')->fetchAll();

$collection = $db->query('SELECT * FROM product WHERE product_id = 1')->fetch();

$new_product = $db->query('SELECT * FROM product ORDER BY product_id DESC LIMIT 7;')->fetchAll();

$category = $db->query('SELECT * FROM category')->fetchAll();

require 'src/pages/home.view.php';