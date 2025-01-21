<?php

namespace src\Controllers;

use Core\Database;
use Exception;

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

    protected function handleValidationError(string $redirectPath, array $errors): void
    {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST;
        $this->redirect($redirectPath);
    }

    protected function handleProcessError(Exception $e = null, string $redirectPath, string $message = null): void
    {
        error_log(get_class($this) . " error: " . $e->getMessage());

        setFlashMessage(
            'status',
            $message ?? "An error occurred. Please try again.",
            'error'
        );

        $this->redirect($redirectPath);
    }

    private function initSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Start the session if not already started
        }
    }
}