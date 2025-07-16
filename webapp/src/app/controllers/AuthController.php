<?php
// app/controllers/AuthController.php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function login()
    {
        // Vérifier si on a envoyé le formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // Vérifier dans la base
            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // OK => on stocke en session
                session_start();
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['user_role'] = $user['role'];
                header('Location: /dashboard.php'); // Redirige vers le tableau de bord
                exit;
            } else {
                // Erreur d'authentification
                $error = "Identifiants invalides.";
                include __DIR__ . '/../views/auth/login.php';
            }
        } else {
            // Afficher simplement la page
            include __DIR__ . '/../views/auth/login.php';
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $password_confirm = trim($_POST['password_confirm'] ?? '');

            // Vérifier les champs
            if ($password !== $password_confirm) {
                $error = "Les mots de passe ne correspondent pas.";
                include __DIR__ . '/../views/auth/register.php';
                return;
            }

            if (User::findByEmail($email)) {
                $error = "Un compte avec cet email existe déjà.";
                include __DIR__ . '/../views/auth/register.php';
                return;
            }

            // Créer l'utilisateur
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $newUserId = User::create($username, $email, $hashed);

            if ($newUserId) {
                header('Location: /auth/login'); // Redirige vers login
                exit;
            } else {
                $error = "Erreur lors de l'inscription. Réessaie plus tard.";
                include __DIR__ . '/../views/auth/register.php';
            }
        } else {
            include __DIR__ . '/../views/auth/register.php';
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /auth/login');
        exit;
    }
}

