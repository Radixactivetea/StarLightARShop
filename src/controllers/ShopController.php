<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;

class ShopController extends Controller
{
    private $authMiddleware;

    private $userRole;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->authMiddleware->redirectRestrictedUsers(['admin']);

        $this->userRole = $this->authMiddleware->getUserRole();
    }
    public function index()
    {
        $selectedCategories = isset($_GET['categories']) ? array_map('intval', $_GET['categories']) : [];
        $priceSort = isset($_GET['price_sort']) && in_array($_GET['price_sort'], ['low_high', 'high_low']) ? $_GET['price_sort'] : 'low_high';

        $products = $this->getProducts($selectedCategories, $priceSort);
        $categories = $this->getCategories();

        $viewData = [
            'products' => $products,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories,
            'priceSort' => $priceSort
        ];

        switch ($this->userRole) {
            
            case AuthService::ROLE_STAFF:
                echo $this->view('seller/shop', $viewData);
                break;

            default:
                echo $this->view('shop', $viewData);
                break;
        }
    }

    private function getProducts(array $selectedCategories, string $priceSort): array
    {
        // Product query
        $product_query = "SELECT DISTINCT p.* FROM product p 
            JOIN product_category pc ON p.product_id = pc.product_id 
            WHERE p.stock_level > 0";

        if (!empty($selectedCategories)) {
            $placeholders = implode(',', array_fill(0, count($selectedCategories), '?'));
            $product_query .= " AND pc.category_id IN ($placeholders)";
        }

        $product_query .= match ($priceSort) {
            'low_high' => " ORDER BY p.price ASC",
            'high_low' => " ORDER BY p.price DESC",
            default => "",
        };

        return $this->db->query($product_query, $selectedCategories)->fetchAll();
    }

    private function getCategories(): array
    {
        // Category query
        $category_query = 'SELECT DISTINCT c.* FROM category c 
            JOIN product_category pc ON c.category_id = pc.category_id 
            JOIN product p ON p.product_id = pc.product_id 
            WHERE p.stock_level > 0;';

        return $this->db->query($category_query)->fetchAll();
    }
}