<?php

require 'function.php';
require 'database/Database.php';

$config = require 'config.php';

$db = new Database($config['database']);

$id = $_GET['id'];

$query = 'select * from items where id = :id';

$post = $db ->query( $query , [':id' => $id])->fetch();

dd($post);

require 'routes/routes.php';