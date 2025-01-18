<?php

namespace src\Controllers;

use Core\Database;

abstract class Controller
{
    protected $db;

    public function __construct()
    {
        $config = require 'config.php';

        $this->db = new Database($config['database']);

        $this->initSession();
    }

    protected function view($name, $data = [])
    {
        extract($data);

        ob_start();

        require "src/pages/{$name}.view.php";

        return ob_get_clean();
    }

    protected function json($data)
    {
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    protected function redirect($path)
    {
        header("Location: {$path}");

        exit();
    }

    private function initSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Start the session if not already started
        }
    }
}