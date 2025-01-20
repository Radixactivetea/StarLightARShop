<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;

class NotificationController extends Controller
{
    protected AuthMiddleware $authMiddleware;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->authMiddleware->redirectRestrictedUsers([AuthService::ROLE_GUEST]);
    }

    public function index()
    {
        echo $this->view('notification');
    }
}