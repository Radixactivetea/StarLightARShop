<?php


// Connect database
$config = require('config.php');
$db = new Database($config['database']);


// Query
$getAr = $db->find('ar', ['ar_id' => $id]);


require 'src/pages/ar.view.php';