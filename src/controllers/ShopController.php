<?php

namespace Src\Controllers;

use Core\AuthMiddleware;

class ShopController extends Controller
{
    private $authMiddleware;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->authMiddleware->handleRestrictedRoles(['admin', 'staff']);
    }
    public function index()
    {
        // Initialization
        $selectedCategories = isset($_GET['categories']) ? array_map('intval', $_GET['categories']) : [];
        $priceSort = isset($_GET['price_sort']) && in_array($_GET['price_sort'], ['low_high', 'high_low']) ? $_GET['price_sort'] : 'low_high';

        // Fetch products and categories
        $products = $this->getProducts($selectedCategories, $priceSort);
        $categories = $this->getCategories();

        // Pass data to the view
        echo $this->view('shop', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories,
            'priceSort' => $priceSort
        ]);
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