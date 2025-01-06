<?php

use Core\Database;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);


// Query


require 'src/pages/seller/orders.view.php';