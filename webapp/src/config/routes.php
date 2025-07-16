<?php
// config/routes.php

require_once __DIR__ . '/../app/controllers/AuthController.php';

// Simple routeur "maison"
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Auth routes
if ($uri === '/auth/login') {
    $controller = new AuthController();
    $controller->login();
    exit;
}

if ($uri === '/auth/register') {
    $controller = new AuthController();
    $controller->register();
    exit;
}

if ($uri === '/auth/logout') {
    $controller = new AuthController();
    $controller->logout();
    exit;
}

