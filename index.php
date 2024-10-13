<?php

$request = $_SERVER['REQUEST_URI'];
$viewDir = '/src/pages/';

switch ($request) {
    case '':
    case '/':
        require __DIR__ . $viewDir . 'home.php';
        break;

    case '/shop':
        require __DIR__ . $viewDir . 'shop.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}