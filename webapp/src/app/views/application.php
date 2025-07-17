<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login');
    exit;
}

require_once __DIR__ . '/../../config/db_logs.php';
$pdo = getLogsPDO();

$userRole = $_SESSION['user_role'] ?? 'guest';

// 🔒 Bloquer l'accès si ce n'est pas un admin
if ($userRole !== 'admin') {
    http_response_code(403);
    include __DIR__ . '/partials/header.php';
    echo '<div class="p-6 text-center text-red-700 font-bold text-xl">🚫 Accès refusé : cette page est réservée aux administrateurs.</div>';
    include __DIR__ . '/partials/footer.php';
    exit;
}

// --- Récupération des services pour l'admin ---
$stmt = $pdo->query("SELECT SysLogTag, COUNT(*) AS total FROM SystemEvents GROUP BY SysLogTag ORDER BY total DESC LIMIT 50");
$services = $stmt->fetchAll();

$pageTitle = "Applications - DockPulse";
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/sidebar.php';
?>

<h2 class="text-2xl font-bold mb-4">⚙️ Applications surveillées</h2>
<p class="mb-4">En tant qu'administrateur, vous voyez toutes les sources de logs récupérées par Rsyslog.</p>

<!-- Liste des services -->
<div class="overflow-x-auto mb-8">
  <table class="min-w-full bg-white rounded shadow text-sm">
    <thead>
      <tr class="bg-gray-200 text-gray-700 text-left">
        <th class="px-2 py-2">Service</th>
        <th class="px-2 py-2">Nombre de logs</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($services as $row): ?>
        <tr class="border-b hover:bg-gray-50">
          <td class="px-2 py-2 font-mono">
            <!-- 🔗 Redirection vers la nouvelle page dédiée -->
            <a href="/application/view?app=<?php echo urlencode($row['SysLogTag']); ?>" class="text-blue-600 hover:underline">
              <?php echo htmlspecialchars($row['SysLogTag']); ?>
            </a>
          </td>
          <td class="px-2 py-2"><?php echo htmlspecialchars($row['total']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>

