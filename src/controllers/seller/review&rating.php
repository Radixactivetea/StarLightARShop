<?php

use Core\Database;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);

// Query
$getAllReview = $db->query('SELECT 
    r.*,
    u.username,
    u.full_name,
    p.name AS product_name,
    p.image_url,
    DATE_FORMAT(r.date, "%d/%m/%Y") AS formatted_date
FROM `review&rating` r
LEFT JOIN `user` u ON r.user_id = u.user_id
LEFT JOIN `product` p ON r.product_id = p.product_id
ORDER BY r.date DESC;')->fetchAll();


require 'src/pages/seller/review&rating.view.php';