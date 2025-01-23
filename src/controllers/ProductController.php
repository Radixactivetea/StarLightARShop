<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;
use Core\FileValidator;
use Core\FormValidator;
use Exception;
use Throwable;
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
        $this->authMiddleware->redirectRestrictedUsers(['staff']);

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

    public function showForm()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_STAFF);

        $selectedCategories = [];
        $categories = $this->getCategories();

        echo $this->view(
            'seller/product.form',
            [
                'selectedCategories' => $selectedCategories,
                'category' => $categories
            ]
        );
    }

    public function showReview()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_STAFF);

        $getAllReview = $this->fetchAllReviews();

        echo $this->view('seller/review&rating', compact('getAllReview'));
    }

    public function replyReview()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_STAFF);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/');
        }

        $validator = new FormValidator($_POST);

        $validator
            ->minLength('replyReviewInput', 1)
            ->maxLength('replyReviewInput', 300)
            ->required('replyReviewInput');

        if ($validator->passes()) {

            try {
                $this->updateReview(replyData: $_POST);

                $this->setNotification(replyData: $_POST);

                clearErrors();

                redirect('/review&rating');

            } catch (Exception $e) {

                $this->handleProcessError($e, '/review&rating');

            }
        } else {

            $this->handleValidationError('/review&rating', $validator->getErrors());

        }
    }

    public function createReview($id)
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_CUSTOMER);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/');
        }

        $validator = new FormValidator($_POST);

        $validator
            ->required('review')
            ->maxLength('review', 1000)
            ->required('rating');

        if ($validator->passes()) {

            $data = $validator->getSanitizedData();

            try {

                $reviewExist = $this->db->find('`review&rating`', ['order_id' => $data['order_id']]);

                if (!empty($reviewExist)) {

                    setFlashMessage(
                        'status',
                        "You already review this product",
                        'error'
                    );

                    redirect("/order/detail/{$id}");
                }

                $this->db->insert(
                    '`review&rating`',
                    [
                        'user_id' => $_SESSION['user_id'],
                        'order_id' => $data['order_id'],
                        'product_id' => $data['product_id'],
                        'review' => $data['review'],
                        'rating' => $data['rating'],
                        'date' => (new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur')))->format('Y-m-d H:i:s')
                    ]
                );

                $this->db->insert(
                    'notifications',
                    [
                        'user_id' => "1fa01c70-a80c-11ef-8f6a-d45d64613b08",
                        'title' => "Get review for {$data['product_id']} ",
                        'message' => $data['review'],
                        'category' => 'Review',
                        'created_at' => (new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur')))->format('Y-m-d H:i:s')
                    ]
                );

                clearErrors();

                setFlashMessage(
                    'status',
                    "Thank you for you review",
                    'success'
                );

                redirect("/order/detail/{$id}");

            } catch (Exception $e) {

                dd($e);

                $this->handleProcessError($e, "/order/detail/{$id}");

            }
        } else {

            setFlashMessage(
                'status',
                $message ?? "An error occurred. Please try again.",
                'error'
            );

            $this->handleValidationError("/order/detail/{$id}", $validator->getErrors());

        }
    }

    public function create()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_STAFF);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/');
        }

        [$validator, $fileValidator] = $this->initializeValidators();

        if ($validator->passes() && $fileValidator->passes()) {

            $productData = $validator->getSanitizedData();

            try {
                $this->processCreate($productData, $fileValidator);

                setFlashMessage('status', 'Product created successfully!', 'success');

                clearErrors();

                redirect('/shop');

            } catch (Exception $e) {

                $this->handleProcessError($e, '/shop');

            }

        } else {

            $this->handleValidationError('/shop/product/create', $validator->getErrors());

        }
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

            $this->handleProcessError($e, '/shop');

        }

    }

    public function update($id)
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_STAFF);

        $product = $this->fetchProduct($id);
        $categories = $this->getCategories();
        $diamensions = $this->fetchDimensions($id);
        $categoryIds = $this->getSelectedCategory($id);
        
        $diamension = $diamensions[0] ?? null;

        echo $this->view(
            'seller/product.form',
            [
                'product' => $product,
                'category' => $categories,
                'selectedCategories' => $categoryIds,
                'diamension' => $diamension
            ]
        );
    }

    public function updateProduct($id)
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_STAFF);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/404');
        }

        [$validator, $fileValidator] = $this->initializeValidators();

        if ($validator->passes()) {

            $productData = $validator->getSanitizedData();

            try {

                $this->processUpdate($productData, $fileValidator);

                setFlashMessage('status', 'Product created updated!', 'success');

                clearErrors();

                redirect('/shop');

            } catch (Throwable  $e) {

                dd($e);

                $this->handleProcessError($e, '/shop');

            }

        } else {

            $fileErrors = $fileValidator->getErrors() ?? [];
            $formErrors = $validator->getErrors() ?? [];
            $errors = array_merge($fileErrors, $formErrors);

            $errors = array_unique($errors, SORT_REGULAR);
            $this->handleValidationError("/shop/product/update/{$id}", $errors);

        }
    }

    private function initializeValidators(): array
    {
        $validator = new FormValidator($_POST);
        $fileValidator = new FileValidator($_FILES['image_url']);

        $validator
            ->required('name')
            ->required('price')
            ->numeric('price')
            ->required('stock')
            ->numeric('stock')
            ->required('description')
            ->maxLength('description', 1000)
            ->required('diameter')
            ->numeric('diameter')
            ->required('height')
            ->numeric('height')
            ->required('weight')
            ->numeric('weight')
            ->required('capacity')
            ->numeric('capacity')
            ->requiredCheckbox('categories');

        $fileValidator
            ->required()
            ->maxSize(5)
            ->allowedTypes(['jpg', 'jpeg', 'png', 'gif'])
            ->maxDimensions(1577, 1978);

        return [$validator, $fileValidator];
    }

    private function processCreate(array $productData, FileValidator $fileValidator): void
    {
        $this->db->transaction(function ($db) use ($productData, $fileValidator) {

            $imagePath = $fileValidator->move('public/upload/product');

            $productId = $db->insert(
                'product',
                [
                    'name' => $productData['name'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'stock_level' => $productData['stock'],
                    'image_url' => $imagePath
                ]
            );

            $db->insert('dimensions', [
                'product_id' => $productId,
                'diameter' => $productData['diameter'],
                'height' => $productData['height'],
                'weight' => $productData['weight'],
                'capacity' => $productData['capacity'],
            ]);

            foreach ($productData['categories'] as $categoryId) {
                $db->insert('product_category', [
                    'product_id' => $productId,
                    'category_id' => $categoryId,
                ]);
            }
        });
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

    private function processUpdate(array $productData, FileValidator $fileValidator): void
    {
        $this->db->transaction(function ($db) use ($productData, $fileValidator) {

            $imagePath = !$fileValidator->isEmpty()
                ? $fileValidator->move('public/upload/product')
                : $productData['image_url'];

            $db->update(
                'product',
                $productData['product_id'],
                [
                    'name' => $productData['name'],
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'stock_level' => $productData['stock'],
                    'image_url' => $imagePath
                ],
                'product_id'
            );

            $db->update(
                'dimensions',
                $productData['product_id'],
                [
                    'diameter' => $productData['diameter'],
                    'height' => $productData['height'],
                    'weight' => $productData['weight'],
                    'capacity' => $productData['capacity']
                ],
                'product_id'
            );

            $originalCategory = $this->getSelectedCategory($productData['product_id']);

            foreach ($originalCategory as $categoryId) {

                $db->delete('product_category', ['category_id' => $categoryId, 'product_id' => $productData['product_id']]);

            }

            foreach ($productData['categories'] as $categoryId) {

                $db->insert('product_category', [
                    'product_id' => $productData['product_id'],
                    'category_id' => $categoryId,
                ]);

            }

        });
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

    private function fetchAllReviews()
    {
        return $this->db->query('SELECT r.*, u.user_id, u.firstname, u.lastname, p.name AS product_name, p.image_url, DATE_FORMAT(r.date, "%d/%m/%Y") AS formatted_date
            FROM `review&rating` r
            LEFT JOIN `user` u ON r.user_id = u.user_id
            LEFT JOIN `product` p ON r.product_id = p.product_id
            ORDER BY r.date DESC;'
        )->fetchAll();
    }

    private function fetchReview($id)
    {
        return $this->db->find('`review&rating', ['review_id']);
    }

    private function updateReview(array $replyData)
    {
        if (!isset($replyData['review_id'], $replyData['replyReviewInput'])) {

            throw new Exception("Missing 'review_id' or 'replyReviewInput' in the data.");

        }

        // Perform the update
        return $this->db->update(
            '`review&rating`',
            $replyData['review_id'],
            ['response' => $replyData['replyReviewInput']],
            'review_id'
        );
    }

    private function getCategories(): array
    {
        return $this->db->query('SELECT * FROM category')->fetchAll();
    }

    private function getSelectedCategory($id)
    {
        $selectedCategories = $this->db->query('SELECT c.category_id, c.name 
            FROM product_category pc JOIN category c ON pc.category_id = c.category_id
            WHERE pc.product_id = :product_id;',
            [
                'product_id' => $id
            ]
        )->fetchAll();

        return array_column($selectedCategories, "category_id");
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

    private function setNotification(array $replyData)
    {
        $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));

        $review = $this->db->find('`review&rating`', ['review_id' => $replyData['review_id']]);

        $this->db->insert(
            'notifications',
            [
                'user_id' => $review['user_id'],
                'title' => "Seller Response Your Review",
                'message' => $replyData['replyReviewInput'],
                'category' => 'Review',
                'created_at' => $dateTime->format('Y-m-d H:i:s')
            ]
        );
    }
}
