<?php

namespace Core;

class AuthMiddleware
{
    private $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    // This method handles login checks
    public function handleLogin()
    {
        if (!$this->auth->checkLogin()) {

            redirect('/login');

        }
    }

    // This method handles role checks
    public function handleRole($requiredRole)
    {
        if (!$this->auth->checkRole($requiredRole)) {

            redirect('/404');

        }
    }

    public function handle($requiredRole = 'customer')
    {
        $this->handleLogin();
        $this->handleRole($requiredRole);
    }
}
