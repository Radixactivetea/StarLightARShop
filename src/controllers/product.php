<?php


use Core\Database;

// Connect database
$config = require 'config.php';
$db = new Database($config['database']);



// Initialization
$percentages = [
    5 => ['rating' => 5, 'rating_count' => 0, 'percentage' => 0],
    4 => ['rating' => 4, 'rating_count' => 0, 'percentage' => 0],
    3 => ['rating' => 3, 'rating_count' => 0, 'percentage' => 0],
    2 => ['rating' => 2, 'rating_count' => 0, 'percentage' => 0],
    1 => ['rating' => 1, 'rating_count' => 0, 'percentage' => 0],
];



// Querry
$product = $db->findOrFail('product', ['product_id' => $id]);

$products = $db->query('SELECT * FROM product ORDER BY RAND() LIMIT 4')->fetchAll();

$dimensions = $db->findAll('dimensions', ['product_id' => $product['product_id']]);

$showReview = $db->query('SELECT *, DATE_FORMAT(`date`, "%d %M %Y") AS `formatted_date` FROM `review&rating` WHERE product_id = :id ORDER BY `date` DESC;', ['id' => $id])->fetchAll();

$ratings = $db->query('SELECT rating, COUNT(*) AS rating_count, (COUNT(*) / (SELECT COUNT(*) 
    FROM `review&rating` WHERE product_id = :id)) * 100 AS percentage
    FROM `review&rating` WHERE product_id = :id
    GROUP BY rating ORDER BY rating DESC;',
    ['id' => $id]
)->fetchAll();

$totalAndAverage = $db->query('SELECT COUNT(*) AS total_reviews,
    ROUND(AVG(rating), 1) AS average_rating
    FROM `review&rating` WHERE product_id = :id;',
    ['id' => $id]
)->fetch();



// Update data
foreach ($ratings as $row) {

    $rating = $row['rating'];

    $percentages[$rating]['rating_count'] = $row['rating_count'];

    $percentages[$rating]['percentage'] = $row['percentage'];
}



// Load page
require 'src/pages/product.view.php';