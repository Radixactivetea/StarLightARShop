<?php

use Core\AuthService;


function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlis($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function redirect($url, $statusCode = 302)
{
    if (is_string($url)) {

        http_response_code($statusCode);

        header("Location: $url");

        exit();

    } else {

        error_log("Invalid redirect attempted: " . var_export($url, true));

        http_response_code(404);

        header("Location: /404");

        exit();
    }
}

function initSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function setFlashMessage($key, $value, $type = 'info')
{
    if (session_status() == PHP_SESSION_NONE) {

        session_start();
    }

    $_SESSION['flash_messages'][$key] = [
        'message' => $value,
        'type' => $type
    ];
}

function getFlashMessage($key)
{
    if (session_status() == PHP_SESSION_NONE) {

        session_start();
    }

    if (isset($_SESSION['flash_messages'][$key])) {

        $message = $_SESSION['flash_messages'][$key];

        unset($_SESSION['flash_messages'][$key]);

        return $message;
    }

    return null;
}

function displayAlert($message = null, $type = 'info')
{
    // If no message is provided, try to get from flash messages
    if ($message === null) {

        $flashMessage = getFlashMessage('status');

        if ($flashMessage !== null && is_array($flashMessage)) {

            $message = $flashMessage['message'];

            $type = $flashMessage['type'];
        }
    }

    // If still no message, return empty string
    if (empty($message)) {
        return '';
    }

    // Determine alert class based on type or message content
    $alertClass = match ($type) {
        'success' => 'alert-success',
        'error' => 'alert-danger',
        'warning' => 'alert-warning',
        'info' => 'alert-info',
        default => strpos(strtolower($message), 'success') !== false
        ? 'alert-success'
        : 'alert-danger'
    };

    // Generate the alert HTML
    return sprintf(
        '<div class="alert %s alert-dismissible fade show ms-3" role="alert">%s
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>',
        $alertClass,
        htmlspecialchars($message)
    );
}

function clearSession()
{
    initSession();

    session_unset();
    session_destroy();
}

function dummyLogin($role)
{
    $auth = new AuthService;

    $credentials = [
        'customer' => ['email' => 'userThree@gmail.com', 'password' => 'Userthree123'],
        'admin' => ['email' => 'wsirajddn@gmail.com', 'password' => 'Pokerface#21'],
        'seller' => ['email' => 'seller@gmail.com', 'password' => 'Seller123'],
    ];

    if (isset($credentials[$role])) {
        $email = $credentials[$role]['email'];
        $password = $credentials[$role]['password'];
        return $auth->login($email, $password);
    }

    // Return false if the role is not recognized
    return false;
}
