<?php

namespace Core;

class AuthMiddleware
{
    private $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function requireLogin()
    {
        if (!$this->auth->checkLogin()) {
            redirect('/login');
        }
    }

    public function requireRole($requiredRole)
    {
        if (!$this->auth->checkRole($requiredRole)) {
            redirect('/404');
        }
    }

    public function redirectRestrictedUsers(array $restrictedRoles, $direction=null)
    {
        $redirectLocation = $this->auth->restrictRoles($restrictedRoles);

        if ($redirectLocation) {

            $redirectLocation = $direction ?: $redirectLocation;
            redirect($redirectLocation);
        }
    }

    public function authenticate($requiredRole = 'customer')
    {
        $this->requireLogin();
        $this->requireRole($requiredRole);
    }

    public function getUserRole()
    {
        return $this->auth->getCurrentUserRole();
    }
}