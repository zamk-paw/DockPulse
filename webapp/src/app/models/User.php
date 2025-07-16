<?php
// app/models/User.php
require_once __DIR__ . '/../../config/db.php';

class User
{
    public static function findByEmail(string $email)
    {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(string $username, string $email, string $hashedPassword, string $role = 'guest')
{
    $pdo = getPDO();
    $stmt = $pdo->prepare(
        "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)"
    );
    $ok = $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password' => $hashedPassword,
        'role' => $role
    ]);
    return $ok ? $pdo->lastInsertId() : false;
}

}
