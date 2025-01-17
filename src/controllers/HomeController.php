<?php

namespace src\Controllers;

class HomeController extends Controller {
    
    public function index() {
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
}