<?php

namespace Core;

class AuthMiddleware
{
    private $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function handleLogin()
    {
        if (!$this->auth->checkLogin()) {

            redirect('/login');

        }
    }

    public function handleRole($requiredRole)
    {
        if (!$this->auth->checkRole($requiredRole)) {

            redirect('/404');

        }
    }

    public function handleRestrictedRoles(array $restrictedRoles)
    {
        $redirectLocation = $this->auth->restrictRoles($restrictedRoles);

        if ($redirectLocation) {
            redirect($redirectLocation);
        }
    }

    public function handle($requiredRole = 'customer')
    {
        $this->handleLogin();
        $this->handleRole($requiredRole);
    }
}
