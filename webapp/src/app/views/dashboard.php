<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login');
    exit;
}
$userRole = $_SESSION['user_role'] ?? 'guest';

$pageTitle = "Dashboard - DockPulse";
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/sidebar.php';
?>

<h2 class="text-2xl font-bold mb-4">Bienvenue sur DockPulse 🚀</h2>
<p class="mb-6 text-gray-700">Voici votre tableau de bord. Utilisez les sections ci-dessous pour accéder rapidement aux fonctionnalités disponibles selon votre rôle.</p>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <!-- Carte Logs : visible pour tout le monde -->
  <a href="/logs" class="block bg-white shadow hover:shadow-lg transition rounded-lg p-6 border border-gray-200">
    <h3 class="font-semibold text-xl mb-2 flex items-center">📋 <span class="ml-2">Logs Docker</span></h3>
    <p class="text-gray-600">Consultez les derniers logs de vos conteneurs Docker.</p>
  </a>

  <!-- Carte Applications : uniquement pour admin -->
  <?php if ($userRole === 'admin'): ?>
    <a href="/application" class="block bg-white shadow hover:shadow-lg transition rounded-lg p-6 border border-gray-200">
      <h3 class="font-semibold text-xl mb-2 flex items-center">⚙️ <span class="ml-2">Applications</span></h3>
      <p class="text-gray-600">Visualisez toutes les sources de logs récupérées par Rsyslog.</p>
    </a>
  <?php endif; ?>

  <!-- Carte Administration : uniquement pour admin -->
  <?php if ($userRole === 'admin'): ?>
    <a href="/admin" class="block bg-white shadow hover:shadow-lg transition rounded-lg p-6 border border-gray-200">
      <h3 class="font-semibold text-xl mb-2 flex items-center">🔐 <span class="ml-2">Administration</span></h3>
      <p class="text-gray-600">Gérez les utilisateurs et les accès.</p>
    </a>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
