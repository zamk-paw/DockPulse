<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login');
    exit;
}
$pageTitle = "Dashboard - DockPulse";
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/sidebar.php';
?>

<h2 class="text-2xl font-bold mb-4">Bienvenue sur DockPulse 🚀</h2>
<p class="mb-6">Voici votre tableau de bord. Utilisez le menu pour naviguer entre les différentes sections.</p>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <div class="bg-white shadow rounded p-4">
    <h3 class="font-semibold text-lg mb-2">📊 Vue d'ensemble</h3>
    <p>Consultez rapidement les derniers logs de Docker.</p>
  </div>
  <div class="bg-white shadow rounded p-4">
    <h3 class="font-semibold text-lg mb-2">⚙️ Applications</h3>
    <p>Visualisez vos conteneurs et leur état en temps réel.</p>
  </div>
  <div class="bg-white shadow rounded p-4">
    <h3 class="font-semibold text-lg mb-2">🔐 Administration</h3>
    <p><?php echo ($_SESSION['user_role'] === 'admin') ? "Gérez les utilisateurs." : "Réservé aux administrateurs."; ?></p>
  </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
