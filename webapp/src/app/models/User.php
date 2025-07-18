<?php
require_once __DIR__ . '/../../config/db.php';

class User {

    /**
     * Retourne un tableau associatif représentant l'utilisateur ou false si non trouvé.
     *
     * @return array<string, mixed>|false
     */
    public static function findByEmail(string $email): array|false {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un utilisateur et retourne true si succès, false sinon.
     */
    public static function create(string $username, string $email, string $hash, string $role = 'guest'): bool {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO users (username,email,password,role) VALUES(:u,:e,:p,:r)");
        return $stmt->execute([
            'u' => $username,
            'e' => $email,
            'p' => $hash,
            'r' => $role
        ]);
    }

    /**
     * Met à jour le rôle et retourne true si succès, false sinon.
     */
    public static function updateRole(int $id, string $role): bool {
        $pdo = getPDO();
        $stmt = $pdo->prepare("UPDATE users SET role = :r WHERE id = :id");
        return $stmt->execute(['r' => $role, 'id' => $id]);
    }

    /**
     * Supprime un utilisateur et retourne true si succès, false sinon.
     */
    public static function delete(int $id): bool {
        $pdo = getPDO();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}

