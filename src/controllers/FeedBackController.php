<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;
use Core\FormValidator;
use Exception;

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
        switch ($this->userRole) {

            case AuthService::ROLE_STAFF:
                $page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? 'feedback';

                $pageMap = [
                    '/help&center/feedback' => 'seller/feedback',
                    '/help&center/request-ban' => 'seller/request-ban',
                    '/help&center/request-seller' => 'seller/request-seller'
                ];

                $view = $pageMap[$page] ?? 'seller/feedback';

                echo $this->view($view);
                break;

            case AuthService::ROLE_CUSTOMER:
                echo $this->view('feedback');
                break;

            case AuthService::ROLE_GUEST:
                echo $this->view('feedback');
                break;

            default:
                echo $this->view('error');
                break;
        }
    }


    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            redirect('/feedback');

        }

        $validation = new FormValidator($_POST);

        $validation->required('experience_details', 'Your experience details')->maxLength('experience_details', 1000, 'Experience details');

        if (!$validation->passes()) {

            $this->handleValidationError('/feedback', $validation->getErrors());
        }

        try {

            $this->insertFeedback();

            setFlashMessage(
                'status',
                'Thank you send in sending your feedback.',
                'info'
            );

            redirect('/feedback');

        } catch (Exception $e) {

            setFlashMessage(
                'status',
                'Error in sending your feedback.',
                'error'
            );

            dd($e);
            redirect('/feedback');
        }
    }

    public function reply()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_ADMIN);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            redirect('/admin');

        }

        $validation = new FormValidator($_POST);

        $validation->required('reply_message')->maxLength('reply_message', 1000);

        if (!$validation->passes()) {

            $this->handleValidationError('/admin', $validation->getErrors());

        }

        $feedbackReply = $validation->getSanitizedData();

        $this->db->update(
            'feedback',
            $feedbackReply['feedback_id'],
            [
                'is_replied' => 1
            ],
            'feedback_id'
        );

        $feedbackReply['title'] = 'Thank you for your feedback';
        $feedbackReply['category'] = 'review';

        $this->setNotification($feedbackReply);

        redirect('/admin');
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

    private function setNotification(array $notificationData)
    {
        $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));

        try {
            $this->db->insert(
                'notifications',
                [
                    'user_id' => $notificationData['user_id'],
                    'title' => $notificationData['title'],
                    'message' => $notificationData['reply_message'],
                    'category' => $notificationData['category'],
                    'created_at' => $dateTime->format('Y-m-d H:i:s')
                ]
            );
        } catch (Exception $e) {

            $this->handleProcessError($e, '/admin', $e);

        }
    }
}