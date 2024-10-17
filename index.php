<?php

require 'function.php';
require 'database/Database.php';

$config = require 'config.php';

$db = new Database($config['database']);

$post = $db ->query("select * from items")->fetchAll();

dd($post);

require 'routes/routes.php';