<?php
require_once __DIR__ . '/../models/User.php';

class AdminController {

    public function changeRole() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
            $userId = (int)$_POST['user_id'];
            $newRole = $_POST['new_role'] === 'admin' ? 'admin' : 'guest';

            // Ne pas changer son propre rôle
            if ($userId === $_SESSION['user_id']) {
                header('Location: /admin?error=self');
                exit;
            }

            User::updateRole($userId, $newRole);
            header('Location: /admin?success=role');
            exit;
        }
    }

    public function deleteUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
            $userId = (int)$_POST['user_id'];

            // Ne pas supprimer son propre compte
            if ($userId === $_SESSION['user_id']) {
                header('Location: /admin?error=selfdelete');
                exit;
            }

            User::delete($userId);
            header('Location: /admin?success=delete');
            exit;
        }
    }
}
