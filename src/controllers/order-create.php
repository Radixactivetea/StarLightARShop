<?php

use Core\Database;
use Core\AuthService;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);
$auth = new AuthService;

$auth->checkLogin();
$auth->checkRole('customer');


require 'src/pages/order-detail.view.php';