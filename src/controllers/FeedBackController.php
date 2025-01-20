<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;

class FeedBackController extends Controller
{
    protected AuthMiddleware $authMiddleware;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();
    }

    public function index()
    {
        echo $this->view('feedback');
    }
}