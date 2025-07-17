<?php
require_once __DIR__ . '/../../config/db.php';

class User {

    public static function findByEmail($email) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($username, $email, $hash, $role='guest') {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO users (username,email,password,role) VALUES(:u,:e,:p,:r)");
        return $stmt->execute([
            'u'=>$username,
            'e'=>$email,
            'p'=>$hash,
            'r'=>$role
        ]);
    }

    public static function updateRole(int $id, string $role) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("UPDATE users SET role = :r WHERE id = :id");
        return $stmt->execute(['r' => $role, 'id' => $id]);
    }

    public static function delete(int $id) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}

