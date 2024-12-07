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

function setFlashMessage($key, $message, $type = 'info')
{
    $_SESSION['flash_messages'][$key] = [
        'message' => $message,
        'type' => $type
    ];
}

function getFlashMessage($key = null)
{
    if ($key === null) {
        // Get all messages
        $messages = $_SESSION['flash_messages'] ?? [];
        unset($_SESSION['flash_messages']);
        return $messages;
    }
    
    // Get specific message
    $message = $_SESSION['flash_messages'][$key] ?? null;
    
    // Clear the message after retrieval
    if ($message !== null) {
        unset($_SESSION['flash_messages'][$key]);
    }
    
    return $message;
}