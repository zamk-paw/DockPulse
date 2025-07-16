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
  <header class="bg-gray-900 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">DockPulse</h1>
    <div>
      <?php if (isset($_SESSION['user_id'])): ?>
        <span class="mr-4">Connecté en tant que <strong><?php echo htmlspecialchars($userRole); ?></strong></span>
        <a href="/auth/logout" class="bg-red-600 px-3 py-1 rounded hover:bg-red-700">Se déconnecter</a>
      <?php else: ?>
        <a href="/auth/login" class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-700">Se connecter</a>
      <?php endif; ?>
    </div>
  </header>

  <div class="flex flex-1">
