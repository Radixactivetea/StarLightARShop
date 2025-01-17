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

    public function login($email, $password)
    {
        $this->ensureSessionStarted();

        $user = $this->getUserFromDatabase($email);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            return $_SESSION['role'];
        }

        return false;
    }

    private function getUserFromDatabase($email)
    {
        $config = require 'config.php';
        $db = new Database($config['database']);

        return $db->find('user', ['email' => $email]);
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
            return false;
        }

        return true;
    }

    public function checkRole($requiredRole)
    {
        $this->ensureSessionStarted();

        if ($_SESSION['role'] !== $requiredRole) {
            return false;
        }

        return true;
    }

    public function restrictRoles(array $restrictedRoles)
    {
        $this->ensureSessionStarted();

        $userRole = $_SESSION['role'] ?? null;

        if (in_array($userRole, $restrictedRoles, true)) {

            $redirectMap = [
                'admin' => '/admin',
                'staff' => '/dashboard'
            ];

            return $redirectMap[$userRole] ?? '/404';
        }

        return null;
    }
}
