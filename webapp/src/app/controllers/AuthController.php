<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                header('Location: /dashboard');
                exit;
            } else {
                $error = "Identifiants invalides.";
                include __DIR__ . '/../views/auth/login.php';
                return;
            }
        }
        include __DIR__ . '/../views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirm = trim($_POST['password_confirm'] ?? '');

            if ($password !== $confirm) {
                $error = "Les mots de passe ne correspondent pas.";
                include __DIR__ . '/../views/auth/register.php';
                return;
            }

            if (User::findByEmail($email)) {
                $error = "Cet email existe déjà.";
                include __DIR__ . '/../views/auth/register.php';
                return;
            }

            User::create($username, $email, password_hash($password, PASSWORD_BCRYPT));
            header('Location: /auth/login');
            exit;
        }
        include __DIR__ . '/../views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /auth/login');
        exit;
    }
}
