<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login');
    exit;
}

require_once __DIR__ . '/../../config/db_logs.php';
$pdo = getLogsPDO();

$userRole = $_SESSION['user_role'] ?? 'guest';

// --- Récupération des services ---
if ($userRole === 'admin') {
    $stmt = $pdo->query("SELECT SysLogTag, COUNT(*) AS total FROM SystemEvents GROUP BY SysLogTag ORDER BY total DESC LIMIT 50");
} else {
    $stmt = $pdo->prepare("SELECT SysLogTag, COUNT(*) AS total FROM SystemEvents WHERE SysLogTag LIKE :docker GROUP BY SysLogTag ORDER BY total DESC");
    $stmt->execute(['docker' => '%docker%']);
}
$services = $stmt->fetchAll();

$pageTitle = "Applications - DockPulse";
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/sidebar.php';
?>

<h2 class="text-2xl font-bold mb-4">⚙️ Applications surveillées</h2>

<?php if ($userRole === 'admin'): ?>
  <p class="mb-4">En tant qu'administrateur, vous voyez toutes les sources de logs récupérées par Rsyslog.</p>
<?php else: ?>
  <p class="mb-4 text-yellow-700">En tant qu'utilisateur invité, vous ne voyez que les logs Docker.</p>
<?php endif; ?>

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

