<?php

namespace src\Controllers;

use Core\AuthMiddleware;

class HomeController extends Controller
{
    private $authMiddleware;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->authMiddleware->redirectRestrictedUsers(['admin']);
    }

    public function index()
    {
        if ($this->authMiddleware->getUserRole() == 'staff') {

            redirect('/dashboard');

        }

        $promotion = $this->db->findAll('promotion');
        $collection = $this->db->find('product', ['product_id' => 2]);

        $new_product = $this->db->findAll('product', [], [
            'orderBy' => 'product_id DESC',
            'limit' => 7
        ]);

        $category = $this->db->query('SELECT DISTINCT c.* FROM category c 
            JOIN product_category pc ON c.category_id = pc.category_id 
            JOIN product p ON p.product_id = pc.product_id 
            WHERE p.stock_level > 0;'
        )->fetchAll();

        echo $this->view('home', [
            'promotion' => $promotion,
            'collection' => $collection,
            'new_product' => $new_product,
            'category' => $category
        ]);
    }

    public function homeSeller()
    {
        $this->authMiddleware->authenticate('staff');

        $summary = $this->fetchSummary();
        $latestOrder = $this->fetchLastestOrder();




        echo $this->view('seller/dashboard', ['summary' => $summary, 'latestOrder' => $latestOrder]);
    }

    public function aboutUs()
    {
        echo $this->view('about');
    }

    private function fetchSummary()
    {
        $result = $this->db->query('
        SELECT 
            (SELECT COUNT(*) FROM product) AS total_products,
            (SELECT COUNT(*) FROM orders) AS total_orders,
            (SELECT COALESCE(SUM(total_price), 0) FROM orders) AS total_revenue,
            (SELECT COALESCE(ROUND(AVG(rating), 2), 0) FROM `review&rating` WHERE rating BETWEEN 1 AND 5) AS average_rating
    ')->fetch();

        // Define target values
        $targetRevenue = 5000;
        $targetOrders = 1000;

        // Calculate percentage of total revenue
        $revenuePercentage = $result['total_revenue'] > 0
            ? ($result['total_revenue'] / $targetRevenue) * 100
            : 0;

        // Calculate percentage of total orders
        $orderPercentage = $result['total_orders'] > 0
            ? ($result['total_orders'] / $targetOrders) * 100
            : 0;

        // Normalize average rating to a percentage out of 5
        $ratingPercentage = ($result['average_rating'] / 5) * 100;

        // Append the calculated percentages to the result array
        $result['revenue_percentage'] = round($revenuePercentage, 2); // Revenue percentage
        $result['order_percentage'] = round($orderPercentage, 2);     // Order percentage
        $result['rating_percentage'] = round($ratingPercentage, 2);  // Rating percentage

        return $result;
    }

    private function fetchLastestOrder()
    {
        return $this->db->query('SELECT * FROM `orders` ORDER BY date DESC LIMIT 3')->fetchAll();
    }
}