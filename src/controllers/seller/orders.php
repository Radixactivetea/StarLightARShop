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

foreach ($getAllOrders as &$order) {
    $statusClass = match (strtolower($order['order_status'])) {
        'paid' => 'status-paid',
        'cancelled' => 'status-cancelled',
        'processing' => 'status-processing',
        'shipped' => 'status-shipped',
        default => 'status-pending'
    };
    $order['status_class'] = $statusClass;

    // Button state logic
    $order['can_add_tracking'] = strtolower($order['order_status']) === 'paid' && empty($order['tracking_number']);
    $order['has_tracking'] = !empty($order['tracking_number']);
}
unset($order);

require 'src/pages/seller/orders.view.php';