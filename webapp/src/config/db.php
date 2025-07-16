<?php
// Charger le .env (adapte le chemin si besoin)
$envPath = __DIR__ . '/.env'; // ton .env est probablement à la racine du projet
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // ignorer les commentaires
        if (!str_contains($line, '=')) continue; // ignorer les lignes invalides
        [$name, $value] = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
} else {
    die("❌ Fichier .env introuvable à l'emplacement : $envPath");
}

// Récupération des identifiants
$host = $_ENV['DB_HOST'] ?? '';
$db = $_ENV['DB_NAME'] ?? '';
$user = $_ENV['DB_USER'] ?? '';
$pass = $_ENV['DB_PASS'] ?? '';
$charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';

// Vérifier que les variables sont bien définies
if (empty($host) || empty($db) || empty($user)) {
    die("❌ Variables d'environnement DB manquantes. Vérifie ton .env");
}

// Connexion PDO
function getPDO(): PDO {
    global $host, $db, $user, $pass, $charset;

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    return new PDO($dsn, $user, $pass, $options);
}
