<?php

namespace Controllers;

abstract class Controller {
    protected $db;
    protected $auth;
    
    public function __construct() {

        $config = require 'config.php';

        $this->db = new \Core\Database($config['database']);

        $this->auth = new \Core\AuthService;
    }
    
    protected function view($name, $data = []) {
        // Extract data to make variables available in view
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Include the view file
        require "src/pages/{$name}.view.php";
        
        // Get the contents and clean the buffer
        return ob_get_clean();
    }
    
    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    protected function redirect($path) {
        header("Location: {$path}");
        exit();
    }
    
    protected function validate($data, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            if (strpos($rule, 'required') !== false && empty($data[$field])) {
                $errors[$field] = "The {$field} field is required";
            }
        }
        
        return $errors;
    }
}