<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login');
    exit;
}

require_once __DIR__ . '/../../config/db_logs.php';
$pdo = getLogsPDO();
$userRole = $_SESSION['user_role'] ?? 'guest';

$appFilter = trim($_GET['app'] ?? '');
if ($appFilter === '') {
    header('Location: /application');
    exit;
}

// Restriction pour guest
if ($userRole !== 'admin' && stripos($appFilter, 'docker') === false) {
    http_response_code(403);
    echo "<h1>403</h1><p>Accès refusé pour cet utilisateur.</p>";
    exit;
}

// Récupération des logs
$stmt = $pdo->prepare("SELECT ID, ReceivedAt, SysLogTag, Message 
                       FROM SystemEvents 
                       WHERE SysLogTag = :tag
                       ORDER BY ID DESC
                       LIMIT 200");
$stmt->execute(['tag' => $appFilter]);
$logs = $stmt->fetchAll();

$pageTitle = "Logs pour $appFilter - DockPulse";
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/sidebar.php';
?>

<h2 class="text-2xl font-bold mb-4">📋 Logs pour <span class="text-blue-600"><?php echo htmlspecialchars($appFilter); ?></span></h2>
<p class="mb-4"><a href="/application" class="text-blue-600 hover:underline">← Retour aux applications</a></p>

<div class="overflow-x-auto">
  <table class="min-w-full bg-white rounded shadow text-sm">
    <thead>
      <tr class="bg-gray-200 text-gray-700 text-left">
        <th class="px-2 py-2">ID</th>
        <th class="px-2 py-2">Date</th>
        <th class="px-2 py-2">Message</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($logs as $log): ?>
        <tr class="border-b hover:bg-gray-50">
          <td class="px-2 py-2"><?php echo $log['ID']; ?></td>
          <td class="px-2 py-2"><?php echo htmlspecialchars($log['ReceivedAt']); ?></td>
          <td class="px-2 py-2 font-mono text-xs"><?php echo nl2br(htmlspecialchars($log['Message'])); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
