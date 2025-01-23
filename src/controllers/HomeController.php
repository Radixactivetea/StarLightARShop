<?php

namespace src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;

class HomeController extends Controller
{
    private $authMiddleware;

    private $roleMethods = [
        AuthService::ROLE_STAFF => 'homeSeller',
        AuthService::ROLE_ADMIN => 'homeAdmin',
        AuthService::ROLE_CUSTOMER => 'homeCustomer',
    ];

    private $userRole;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->userRole = $this->authMiddleware->getUserRole();
    }

    public function index()
    {
        if (isset($this->roleMethods[$this->userRole]) && method_exists($this, $this->roleMethods[$this->userRole])) {
            $this->{$this->roleMethods[$this->userRole]}();
            return;
        }

        $this->homeCustomer();
    }

    private function homeCustomer()
    {
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

    private function homeSeller()
    {
        $this->authMiddleware->authenticate('staff');

        $summary = $this->fetchSummary();
        $latestOrder = $this->fetchLastestOrder();

        echo $this->view('seller/dashboard', ['summary' => $summary, 'latestOrder' => $latestOrder]);
    }

    private function homeAdmin()
    {
        $overview = $this->getAdminOverview();
        $feedbacks = $this->fetchFeedback();

        echo $this->view(
            'admin/dashboard',
            [
                'overview' => $overview,
                'feedbacks' => $feedbacks
            ]
        );
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

    private function getAdminOverview()
    {
        return $this->db->query('SELECT (SELECT COUNT(*) FROM user) AS total_users, (SELECT COUNT(*) FROM ar) AS total_ar,
            (SELECT COUNT(*) FROM feedback) AS total_feedback, (SELECT COUNT(*) FROM user WHERE banned = 1) AS total_banned_users;'
        )->fetch();
    }

    private function fetchFeedback()
    {
        return $this->db->findAll('feedback');
    }
}