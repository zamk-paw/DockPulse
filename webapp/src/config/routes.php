<?php
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

// -------- ROUTES PUBLIQUES -------- //
if ($uri === '' || $uri === '/') {
    // Redirection vers dashboard si connecté, sinon login
    if (isset($_SESSION['user_id'])) {
        header('Location: /dashboard');
        exit;
    } else {
        header('Location: /auth/login');
        exit;
    }
}

// Auth
if ($uri === '/auth/login') {
    (new AuthController())->login();
    exit;
}

if ($uri === '/auth/register') {
    (new AuthController())->register();
    exit;
}

if ($uri === '/auth/logout') {
    (new AuthController())->logout();
    exit;
}

// -------- ROUTES PROTÉGÉES -------- //
if (!isset($_SESSION['user_id'])) {
    // Si on arrive ici sans session => redirection login
    header('Location: /auth/login');
    exit;
}

// Dashboard
if ($uri === '/dashboard') {
    $pageTitle = "Dashboard - DockPulse";
    include __DIR__ . '/../app/views/dashboard.php';
    exit;
}

// Logs
if ($uri === '/logs') {
    $pageTitle = "Logs - DockPulse";
    include __DIR__ . '/../app/views/logs.php';
    exit;
}

// Application
if ($uri === '/application') {
    $pageTitle = "Applications - DockPulse";
    include __DIR__ . '/../app/views/application.php';
    exit;
}

// Admin
if ($uri === '/admin') {
    if (($_SESSION['user_role'] ?? 'guest') !== 'admin') {
        http_response_code(403);
        echo "<h1>403</h1><p>Accès réservé aux administrateurs.</p>";
        exit;
    }
    $pageTitle = "Administration - DockPulse";
    include __DIR__ . '/../app/views/admin.php';
    exit;
}

// Admin actions
if ($uri === '/admin/change-role' && ($_SESSION['user_role'] ?? 'guest') === 'admin') {
    (new AdminController())->changeRole();
    exit;
}

if ($uri === '/admin/delete-user' && ($_SESSION['user_role'] ?? 'guest') === 'admin') {
    (new AdminController())->deleteUser();
    exit;
}

if ($uri === '/logs') {
    $pageTitle = "Logs - DockPulse";
    include __DIR__ . '/../app/views/logs.php';
    exit;
}

if ($uri === '/application') {
    $pageTitle = "Applications - DockPulse";
    include __DIR__ . '/../app/views/application.php';
    exit;
}

if ($uri === '/application/view') {
    $pageTitle = "Logs d'application - DockPulse";
    include __DIR__ . '/../app/views/application_view.php';
    exit;
}

// -------- SI AUCUNE ROUTE NE CORRESPOND -------- //
http_response_code(404);
echo "<h1>404</h1><p>Page non trouvée : $uri</p>";

