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
    initSession();

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

    $alertClass = match ($type) {
        'success' => 'alert-success',
        'error' => 'alert-danger',
        'warning' => 'alert-warning',
        'info' => 'alert-info',
        default => strpos(strtolower($message), 'success') !== false
        ? 'alert-success'
        : 'alert-danger'
    };

    // Get modal icon based on type
    $icon = match ($type) {
        'success' => '<i class="bi bi-check-circle-fill text-success fs-1"></i>',
        'error' => '<i class="bi bi-x-circle-fill text-danger fs-1"></i>',
        'warning' => '<i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>',
        'info' => '<i class="bi bi-info-circle-fill text-info fs-1"></i>',
        default => '<i class="bi bi-info-circle-fill text-info fs-1"></i>'
    };

    // Generate the modal HTML
    return sprintf(
        '<div class="modal" id="alertModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header %s border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center pb-5">
                        <div class="mb-4">
                            %s
                        </div>
                        <div>
                            %s
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var modal = new bootstrap.Modal(document.getElementById("alertModal"), {
                    backdrop: "static",
                    keyboard: false
                });
                modal.show();
                
                // Auto close after 5 seconds for success messages
                if ("%s" === "success") {
                    setTimeout(function() {
                        modal.hide();
                    }, 5000);
                }
            });
        </script>',
        $alertClass,
        $icon,
        htmlspecialchars($message),
        $type
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

function old(string $key, $default = '')
{
    initSession();
    if (isset($_SESSION['old'][$key])) {
        $value = $_SESSION['old'][$key];
        unset($_SESSION['old'][$key]);
        return htmlspecialchars($value);
    }
    return $default;
}

function hasError(string $field): bool
{
    initSession();
    return isset($_SESSION['errors'][$field]);
}

function getError(string $field): string
{
    initSession();
    if (isset($_SESSION['errors'][$field])) {
        $error = $_SESSION['errors'][$field];
        unset($_SESSION['errors'][$field]);
        return $error;
    }
    return '';
}

function clearErrors(): void
{
    initSession();
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
}

function showError(string $field): void
{
    if (hasError($field)) {
        echo '<p class="text-danger mt-1 ms-1" style="font-size: 10px;">' . getError($field) . '</p>';
    }
}
