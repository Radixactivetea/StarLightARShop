<?php


$config = require ('config.php');
$db = new Database($config['database']);

$promotion = $db->query('SELECT * FROM promotion')->fetchAll();

$collection = $db->query('SELECT * FROM product WHERE product_id = 2')->fetch();

$new_product = $db->query('SELECT * FROM product LIMIT 7')->fetchAll();

require 'src/pages/home.view.php';