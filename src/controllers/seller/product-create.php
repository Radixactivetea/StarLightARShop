<?php
session_start();

use Core\Database;
use Core\FormValidator;
use Core\FileValidator;

// Connect to the database
$config = require 'config.php';
$db = new Database($config['database']);


$selectedCategories = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $validator = new FormValidator($_POST);
    $fileValidator = new FileValidator($_FILES['image_url']);

    $selectedCategories = $_POST['categories'] ?? [];

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


    if ($validator->passes() && $fileValidator->passes()) {

        $productData = $validator->getSanitizedData();

        try {

            $db->transaction(function ($db) use ($productData, $fileValidator) {

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

            setFlashMessage(
                'status',
                'Product created successfully!',
                'success'
            );

            redirect('/manage/products');

        } catch (Exception $e) {

            $transactionError = "We're sorry, 
            but there seems to be an issue with creating the new pottery product. Please try again.";
            error_log("Product creation error: " . $e->getMessage());

            setFlashMessage(
                'status',
                $transactionError,
                'error'
            );

            redirect('/product/create');
        }

    } else {

        $errors = $validator->getErrors();

        $imageErrors = $fileValidator->getErrors();
    }
}


$category = $db->query('SELECT * FROM category')->fetchAll();


require 'src/pages/seller/product-create.view.php';