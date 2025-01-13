<?php

namespace Core;

use Core\Database;

class AuthService
{
    private function ensureSessionStarted()
    {
        if (session_status() === PHP_SESSION_NONE) {

            session_start();

        }
    }

    public function login($username, $password)
    {
        $this->ensureSessionStarted();

        $user = $this->getUserFromDatabase($username);

        if ($user && password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['user_id'];

            $_SESSION['role'] = $user['role'];

            return true;
        }

        return false;
    }

    private function getUserFromDatabase($username)
    {
        $config = require 'config.php';
        $db = new Database($config['database']);

        return $db->find('user', ['username' => $username]);
    }

    public function logout()
    {
        $this->ensureSessionStarted();

        session_unset();

        session_destroy();
    }

    public function checkLogin()
    {
        $this->ensureSessionStarted();

        if (!isset($_SESSION['user_id'])) {

            redirect('/login');

        }
    }

    public function checkRole($requiredRole)
    {
        $this->checkLogin();

        if ($_SESSION['role'] !== $requiredRole) {

            redirect('/404');

        }
    }
}