<?php

use Core\Database;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);


// Query
$getAllOrders = $db->query('SELECT 
    o.*,
    u.username,
    DATE_FORMAT(o.date, "%d/%m/%Y") AS formatted_date,
    DATE_FORMAT(o.time, "%h:%i %p") AS formatted_time
FROM `orders` o
LEFT JOIN `user` u ON o.user_id = u.user_id
ORDER BY o.date DESC;')->fetchAll();


require 'src/pages/seller/orders.view.php';