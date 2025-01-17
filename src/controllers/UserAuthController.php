<?php

namespace Src\Controllers;

use Core\AuthService;
use Core\FormValidator;
use Exception;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        echo $this->view('login');
    }

    public function showRegister()
    {
        $email = $this->sanitizeInput($_GET['email'] ?? '');

        echo $this->view('register', [
            'email' => $email
        ]);
    }

    public function showVerify()
    {
        $email = $this->sanitizeInput($_GET['email'] ?? '');

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

        $validator = new FormValidator($_POST);
        $validator
            ->required('email')
            ->email('email');

        if (!$validator->passes()) {
            $this->handleValidationError('/login', $validator->getErrors());
        }

        clearErrors();

        $email = $this->sanitizeInput($_POST['email']);

        try {
            $user = $this->db->find('user', ['email' => $email]);

            if ($user) {

                redirect("/verify?email=" . urlencode($email));

            } else {

                redirect("/register?email=" . urlencode($email));

            }
        } catch (Exception $e) {

            $this->handleAuthError($e, '/login');

        }
    }

    public function processRegistration()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/');
        }

        $validator = new FormValidator($_POST);
        $validator
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

        if (!$validator->passes()) {

            $this->handleValidationError('/register', $validator->getErrors());

        }

        clearErrors();

        try {

            $email = $this->sanitizeInput($_GET['email'] ?? '');

            if (empty($email)) {

                throw new Exception('Email is required');

            }

            $userData = [
                'username' => $this->sanitizeInput($_POST['username']),
                'full_name' => $this->sanitizeInput($_POST['fullname']),
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                'email' => $email,
                'date_of_birth' => sprintf(
                    '%04d-%02d-%02d',
                    $_POST['dob_year'],
                    $_POST['dob_month'],
                    $_POST['dob_day']
                ),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('user', $userData);

            setFlashMessage('status', 'Registration successful! Please login.', 'success');
            redirect("/verify?email=" . urlencode($email));

        } catch (Exception $e) {

            $this->handleAuthError($e, '/register');

        }
    }

    public function processVerification()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/');
        }

        $validator = new FormValidator($_POST);
        $validator
            ->required('password');

        if (!$validator->passes()) {

            $this->handleValidationError('/verify', $validator->getErrors());

        }

        clearErrors();

        try {

            $email = $this->sanitizeInput($_GET['email'] ?? '');

            if (empty($email)) {

                throw new Exception('Email is required');

            }

            $auth = new AuthService();

            $user = $auth->login($email, $_POST['password']);

            switch ($user) {
                case 'customer':
                    redirect('/');
                    break;
                case 'staff':
                    redirect('/dashboard');
                    break;
                case 'admin':
                    redirect('/admin');
                    break;
                default:
                    redirect('/404');
                    break;
            }

        } catch (Exception $e) {

            $this->handleAuthError($e, '/verify');

        }
    }

    private function initializeUserSession(array $user): void
    {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['last_activity'] = time();
    }

    private function sanitizeInput(string $input): string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    private function handleValidationError(string $redirectPath, array $errors): void
    {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST;
        redirect($redirectPath);
    }

    private function handleAuthError(Exception $e, string $redirectPath): void
    {
        error_log("Authentication error: " . $e->getMessage());
        setFlashMessage('status', 'An error occurred. Please try again.', 'error');
        redirect($redirectPath);
    }

    public function logout()
    {
        session_destroy();
        redirect('/');
    }
}