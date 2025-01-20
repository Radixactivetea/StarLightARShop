<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;

class FeedBackController extends Controller
{
    protected AuthMiddleware $authMiddleware;
    private $userRole;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->userRole = $this->authMiddleware->getUserRole();

        $this->authMiddleware->redirectRestrictedUsers([AuthService::ROLE_GUEST]);
    }

    public function index()
    {
        if ($this->userRole == AuthService::ROLE_STAFF) {

            echo $this->view('seller/feedback');

        } else if ($this->userRole == AuthService::ROLE_STAFF) {

            echo $this->view('feedback');
        }
    }
}