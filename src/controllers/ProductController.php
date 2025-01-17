<?php

namespace Src\Controllers;

use Core\Database;

class ProductController extends Controller
{
    public function show(int $id)
    {
        $product = $this->fetchProduct($id);

        $products = $this->fetchRandomProducts();

        $dimensions = $this->fetchDimensions($product['product_id']);

        $showReview = $this->fetchReviews($id);

        $ratings = $this->fetchRatings($id);
        
        $totalAndAverage = $this->fetchTotalAndAverage($id);

        $percentages = $this->processRatings($ratings);

        echo $this->view('product', compact(
            'product',
            'products',
            'dimensions',
            'showReview',
            'percentages',
            'totalAndAverage'
        ));
    }

    private function fetchProduct(int $id)
    {
        return $this->db->findOrFail('product', ['product_id' => $id]);
    }

    private function fetchRandomProducts()
    {
        return $this->db->query('SELECT * FROM product ORDER BY RAND() LIMIT 4')->fetchAll();
    }

    private function fetchDimensions(int $productId)
    {
        return $this->db->findAll('dimensions', ['product_id' => $productId]);
    }

    private function fetchReviews(int $id)
    {
        return $this->db->query('SELECT *, DATE_FORMAT(`date`, "%d %M %Y") AS `formatted_date` 
            FROM `review&rating` WHERE product_id = :id ORDER BY `date` DESC;',
            ['id' => $id]
        )->fetchAll();
    }

    private function fetchRatings(int $id)
    {
        return $this->db->query('SELECT rating, COUNT(*) AS rating_count, 
            (COUNT(*) / (SELECT COUNT(*) FROM `review&rating` WHERE product_id = :id)) * 100 AS percentage
            FROM `review&rating` WHERE product_id = :id
            GROUP BY rating ORDER BY rating DESC;',
            ['id' => $id]
        )->fetchAll();
    }

    private function fetchTotalAndAverage(int $id)
    {
        return $this->db->query('SELECT COUNT(*) AS total_reviews,
            ROUND(AVG(rating), 1) AS average_rating
            FROM `review&rating` WHERE product_id = :id;',
            ['id' => $id]
        )->fetch();
    }

    private function processRatings(array $ratings)
    {
        $percentages = [
            5 => ['rating' => 5, 'rating_count' => 0, 'percentage' => 0],
            4 => ['rating' => 4, 'rating_count' => 0, 'percentage' => 0],
            3 => ['rating' => 3, 'rating_count' => 0, 'percentage' => 0],
            2 => ['rating' => 2, 'rating_count' => 0, 'percentage' => 0],
            1 => ['rating' => 1, 'rating_count' => 0, 'percentage' => 0],
        ];

        foreach ($ratings as $row) {
            $rating = $row['rating'];
            $percentages[$rating]['rating_count'] = $row['rating_count'];
            $percentages[$rating]['percentage'] = $row['percentage'];
        }

        return $percentages;
    }
}
