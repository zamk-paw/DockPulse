<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userRole = $_SESSION['user_role'] ?? 'guest';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle ?? 'DockPulse'; ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-gray-900 text-white shadow-md sticky top-0 z-50">
    <div class="px-4">
      <div class="flex justify-between items-center h-16">
        <!-- Logo & Nom -->
        <div class="flex items-center space-x-3">
          <!-- Icône -->
          <div class="w-10 h-10 bg-blue-600 flex items-center justify-center rounded-lg shadow-inner">
            <span class="text-xl font-extrabold">🐳</span>
          </div>
          <!-- Titre -->
          <h1 class="text-2xl font-bold tracking-wide">DockPulse</h1>
        </div>

        <!-- Actions utilisateur -->
        <div class="flex items-center space-x-4">
          <?php if (isset($_SESSION['user_id'])): ?>
            <div class="flex items-center space-x-2">
              <span class="hidden sm:inline">Connecté en tant que</span>
              <?php if ($userRole === 'admin'): ?>
                <span class="px-2 py-1 rounded-full text-sm font-semibold bg-green-600">Admin</span>
              <?php else: ?>
                <span class="px-2 py-1 rounded-full text-sm font-semibold bg-gray-600">Invité</span>
              <?php endif; ?>
            </div>
            <a href="/auth/logout" class="bg-red-600 hover:bg-red-700 transition-colors px-4 py-2 rounded-md font-medium">
              Se déconnecter
            </a>
          <?php else: ?>
            <a href="/auth/login" class="bg-blue-600 hover:bg-blue-700 transition-colors px-4 py-2 rounded-md font-medium">
              Se connecter
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>

  <!-- Contenu principal -->
  <div class="flex flex-1">

