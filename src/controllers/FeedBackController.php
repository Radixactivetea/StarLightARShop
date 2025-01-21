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
    }

    public function index()
    {
        if ($this->userRole == AuthService::ROLE_STAFF) {

            echo $this->view('seller/feedback');

        } else  {

            echo $this->view('feedback');

        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            redirect('/feedback');

        }

        try {

            $this->insertFeedback();

            redirect('/feedback');

        } catch (\Exception $e) {

            setFlashMessage(
                'status',
                'Error in sending your feedback.',
                'error'
            );

            dd($e);
            redirect('/feedback');
        }
    }

    private function insertFeedback()
    {
        $this->db->insert(
            'feedback',
            [
                'user_id' => $_SESSION['user_id'],
                'rating' => $_POST['rating'],
                'experience_details' => $_POST['experience_details'],
                'feature_suggestions' => $_POST['suggestions'],
                'submitted_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}