<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login');
    exit;
}

require_once __DIR__ . '/../../config/db_logs.php';
$pdo = getLogsPDO();

// On récupère déjà les logs docker
$stmt = $pdo->prepare("SELECT ID, ReceivedAt, FromHost, SysLogTag, Message
                       FROM SystemEvents
                       WHERE SysLogTag LIKE :docker
                       ORDER BY ID DESC
                       LIMIT 200");
$stmt->execute(['docker' => '%docker%']);
$logs = $stmt->fetchAll();

$pageTitle = "Logs Docker - DockPulse";
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/sidebar.php';
?>

<h2 class="text-2xl font-bold mb-4">🐳 Logs Docker</h2>
<p class="mb-4">Recherche instantanée locale dans les logs affichés ci-dessous.</p>

<!-- Champ de recherche en JS -->
<div class="mb-4">
  <input type="text" id="searchInput"
    placeholder="Rechercher dans le tableau..."
    class="border px-3 py-2 rounded w-96">
</div>

<div class="overflow-x-auto">
  <table id="logsTable" class="min-w-full bg-white rounded shadow text-sm">
    <thead>
      <tr class="bg-gray-200 text-gray-700 text-left">
        <th class="px-2 py-2">ID</th>
        <th class="px-2 py-2">Date</th>
        <th class="px-2 py-2">Hôte</th>
        <th class="px-2 py-2">Tag</th>
        <th class="px-2 py-2">Message</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($logs)): ?>
        <tr><td colspan="5" class="px-2 py-2">Aucun log trouvé.</td></tr>
      <?php else: ?>
        <?php foreach ($logs as $log): ?>
          <tr class="border-b hover:bg-gray-50">
            <td class="px-2 py-2"><?php echo $log['ID']; ?></td>
            <td class="px-2 py-2"><?php echo htmlspecialchars($log['ReceivedAt']); ?></td>
            <td class="px-2 py-2"><?php echo htmlspecialchars($log['FromHost']); ?></td>
            <td class="px-2 py-2"><?php echo htmlspecialchars($log['SysLogTag']); ?></td>
            <td class="px-2 py-2 font-mono text-xs"><?php echo nl2br(htmlspecialchars($log['Message'])); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Script JS pour la recherche -->
<script>
  document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#logsTable tbody tr');

    rows.forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(searchValue) ? '' : 'none';
    });
  });
</script>

<?php include __DIR__ . '/partials/footer.php'; ?>

