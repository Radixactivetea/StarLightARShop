<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;
use Exception;
class ProductController extends Controller
{
    private $authMiddleware;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->authMiddleware->redirectRestrictedUsers(['admin']);
    }

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

    public function delete()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_STAFF);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/');
        }

        $productId = $_POST['delete-product-id'] ?? null;

        if (!$productId || !is_numeric($productId)) {

            setFlashMessage('status', 'Invalid product ID.', 'error');

            redirect('/shop');
        }

        try {

            $this->processDelete((int) $productId);

        } catch (Exception $e) {

            $this->handleProductError($e);

        }

    }

    private function processDelete(int $id): void
    {
        $product = $this->fetchProduct($id);

        if (!$product) {

            throw new Exception('Product not found');

        }

        $this->deleteProductImage($product['image_url']);

        $isDeleted = $this->db->delete('product', ['product_id' => $id]);

        if (!$isDeleted) {
            
            throw new Exception('Failed to delete the product.');

        }

        setFlashMessage('status', 'Product deleted successfully.', 'success');
        redirect('/shop');
    }

    private function deleteProductImage(string $imageUrl): void
    {
        $imagePath = "public/upload/product/{$imageUrl}";

        if (file_exists($imagePath)) {

            unlink($imagePath);

        }
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

    private function handleProductError(Exception $e): void
    {
        error_log("Order creation error: " . $e->getMessage());

        setFlashMessage(
            'status',
            "We're sorry, but there was an issue processing your product. Please try again.",
            'error'
        );

        redirect('/shop');
    }
}
