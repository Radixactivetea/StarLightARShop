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

function setFlashMessage($key, $value)
{
    if (session_status() == PHP_SESSION_NONE) {
        
        session_start();
    }

    $_SESSION['flash_messages'][$key] = $value;
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