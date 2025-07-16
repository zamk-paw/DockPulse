<?php
// Vérifier que l'utilisateur est connecté et est admin
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? 'guest') !== 'admin') {
    http_response_code(403);
    echo "<h1>403</h1><p>Accès refusé</p>";
    exit;
}

require_once __DIR__ . '/../../config/db.php';
$pdo = getPDO();
$users = $pdo->query("SELECT id, username, email, role, created_at FROM users ORDER BY id DESC")->fetchAll();

$pageTitle = "Administration - DockPulse";
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/sidebar.php';
?>

<h2 class="text-2xl font-bold mb-4">👑 Administration</h2>
<p class="mb-6">Gestion des utilisateurs DockPulse</p>

<table class="min-w-full bg-white rounded shadow">
  <thead>
    <tr class="bg-gray-200 text-gray-700 text-left">
      <th class="px-4 py-2">ID</th>
      <th class="px-4 py-2">Nom d'utilisateur</th>
      <th class="px-4 py-2">Email</th>
      <th class="px-4 py-2">Rôle</th>
      <th class="px-4 py-2">Créé le</th>
      <th class="px-4 py-2">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr class="border-b hover:bg-gray-50">
        <td class="px-4 py-2"><?php echo htmlspecialchars($user['id']); ?></td>
        <td class="px-4 py-2"><?php echo htmlspecialchars($user['username']); ?></td>
        <td class="px-4 py-2"><?php echo htmlspecialchars($user['email']); ?></td>
        <td class="px-4 py-2">
          <?php if ($user['role'] === 'admin'): ?>
            <span class="text-green-600 font-bold">admin</span>
          <?php else: ?>
            <span class="text-gray-600">guest</span>
          <?php endif; ?>
        </td>
        <td class="px-4 py-2"><?php echo htmlspecialchars($user['created_at']); ?></td>
      <td class="px-4 py-2">
  <?php if ($user['id'] != $_SESSION['user_id']): ?>
    <!-- Formulaire pour changer le rôle -->
    <form action="/admin/change-role" method="POST" class="inline">
      <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
      <input type="hidden" name="new_role" value="<?php echo ($user['role'] === 'admin') ? 'guest' : 'admin'; ?>">
      <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700 text-sm">
        <?php echo ($user['role'] === 'admin') ? 'Passer Guest' : 'Passer Admin'; ?>
      </button>
    </form>

    <!-- Formulaire pour supprimer l'utilisateur -->
    <form action="/admin/delete-user" method="POST" class="inline" onsubmit="return confirm('Supprimer cet utilisateur ?');">
      <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
      <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-sm">
        Supprimer
      </button>
    </form>
  <?php else: ?>
    <span class="text-gray-400 text-sm">Moi-même</span>
  <?php endif; ?>
</td>
	</tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include __DIR__ . '/partials/footer.php'; ?>
