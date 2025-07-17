<?php
// Charger .env
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (!str_contains($line, '=')) continue;
        [$k, $v] = explode('=', $line, 2);
        $_ENV[trim($k)] = trim($v);
    }
}

// tu peux ajouter ces variables dans ton .env ou les fixer ici :
$logs_host = $_ENV['DB_LOGS_HOST'] ?? 'localhost';
$logs_db   = $_ENV['DB_LOGS_NAME'] ?? 'mysql_db';
$logs_user = $_ENV['DB_LOGS_USER'] ?? 'root';
$logs_pass = $_ENV['DB_LOGS_PASS'] ?? 'monpass';
$logs_charset = $_ENV['DB_LOGS_CHARSET'] ?? 'utf8mb4';

function getLogsPDO(): PDO {
    global $logs_host, $logs_db, $logs_user, $logs_pass, $logs_charset;
    $dsn = "mysql:host=$logs_host;dbname=$logs_db;charset=$logs_charset";
    return new PDO($dsn, $logs_user, $logs_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}
