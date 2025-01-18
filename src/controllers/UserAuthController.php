<?php

namespace Src\Controllers;

use Core\AuthService;
use Core\FormValidator;
use Exception;

class UserAuthController extends Controller
{
    private FormValidator $validator;

    public function __construct()
    {
        parent::__construct();
        $this->validator = new FormValidator(array_merge($_GET, $_POST));
    }

    public function showLogin()
    {
        echo $this->view('login');
    }

    public function showRegister()
    {
        $email = $this->validator->sanitize($_GET['email'] ?? '');

        echo $this->view('register', [
            'email' => $email
        ]);
    }

    public function showVerify()
    {
        $email = $this->validator->sanitize($_GET['email'] ?? '');

        if (empty($email)) {
            redirect('/login');
        }

        echo $this->view('verify', [
            'email' => $email
        ]);
    }

    public function processLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/');
        }

        $this->validator
            ->required('email')
            ->email('email');

        if (!$this->validator->passes()) {
            $this->handleValidationError('/login', $this->validator->getErrors());
        }

        clearErrors();

        $email = $this->validator->sanitize($_POST['email'] ?? '');

        try {
            $user = $this->db->find('user', ['email' => $email]);

            if ($user) {
                redirect("/verify?email=" . urlencode($email));
            } else {
                redirect("/register?email=" . urlencode($email));
            }
        } catch (Exception $e) {
            $this->handleProcessError($e, '/login');
        }
    }

    public function processRegistration()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/');
        }

        $this->validator
            ->required('username')
            ->required('fullname')
            ->required('password')
            ->required('dob_day')
            ->required('dob_month')
            ->required('dob_year')
            ->minLength('password', 8)
            ->numeric('dob_day')
            ->numeric('dob_month')
            ->numeric('dob_year');

        if (!$this->validator->passes()) {
            $this->handleValidationError('/register', $this->validator->getErrors());
        }

        clearErrors();

        try {
            $email = $this->validator->sanitize($_GET['email'] ?? '');

            if (empty($email)) {
                throw new Exception('Email is required');
            }

            $userData = [
                'username' => $this->validator->sanitize($_POST['username'] ?? ''),
                'full_name' => $this->validator->sanitize($_POST['fullname'] ?? ''),
                'password' => password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT),
                'email' => $email,
                'date_of_birth' => sprintf(
                    '%04d-%02d-%02d',
                    $_POST['dob_year'] ?? '',
                    $_POST['dob_month'] ?? '',
                    $_POST['dob_day'] ?? ''
                )
            ];

            $this->db->insert('user', $userData);

        } catch (Exception $e) {
            dd($e);
            $this->handleProcessError($e, '/register');
        }

        $this->handleLoginAndRedirect($userData['email'], $_POST['password'] ?? '');
    }

    public function processVerification()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/');
        }

        $this->validator->required('password');

        if (!$this->validator->passes()) {

            $this->handleValidationError('/verify', $this->validator->getErrors());
        }

        clearErrors();

        try {
            $email = $this->validator->sanitize($_GET['email'] ?? '');

            if (empty($email)) {
                throw new Exception('Email is required');
            }

            $this->handleLoginAndRedirect($email, $_POST['password'] ?? '');

        } catch (Exception $e) {

            $this->handleProcessError($e, '/verify');

        }
    }

    private function handleLoginAndRedirect($email, $password)
    {
        $auth = new AuthService();

        $userRole = $auth->login($email, $password);

        if (!$userRole) {

            $this->handleValidationError("/verify?email=" . urlencode($email), ['password' => 'Sorry, Wrong password. Please try again']);

        }

        switch ($userRole) {
            case AuthService::ROLE_CUSTOMER:
                redirect('/');
                break;
            case AuthService::ROLE_STAFF:
                redirect('/dashboard');
                break;
            case AuthService::ROLE_ADMIN:
                redirect('/admin');
                break;
            default:
                redirect('/404');
                break;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        redirect('/');
    }
}