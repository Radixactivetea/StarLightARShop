<?php


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
    $alertClass = match($type) {
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