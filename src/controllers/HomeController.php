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
        if($this->authMiddleware->getUserRole() == 'staff'){

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

        echo $this->view('seller/dashboard');
    }

    public function aboutUs()
    {
        echo $this->view('about');
    }
}