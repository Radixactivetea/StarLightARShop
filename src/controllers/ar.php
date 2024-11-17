<?php


// Connect database
$config = require('config.php');
$db = new Database($config['database']);


// Query
$getAr = $db->query('SELECT * FROM ar WHERE ar_id = :id', ['id' => $id])->get();


require 'src/pages/ar.view.php';