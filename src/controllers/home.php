<?php


$config = require ('config.php');
$db = new Database($config['database']);

$promotion = $db->query('SELECT * FROM promotion')->fetchAll();

require 'src/pages/home.view.php';