<!-- views/logs.php -->
<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<h2 class="text-2xl font-bold mb-4">Vue d’ensemble des Logs</h2>
<div class="overflow-x-auto bg-white shadow rounded">
  <table class="min-w-full text-left">
    <thead class="bg-gray-100">
      <tr>
        <th class="py-2 px-4">ID</th>
        <th class="py-2 px-4">Date</th>
        <th class="py-2 px-4">Type</th>
        <th class="py-2 px-4">Message</th>
      </tr>
    </thead>
    <tbody>
      <!-- Boucle PHP pour afficher les logs -->
      <?php foreach ($logs as $log): ?>
      <tr class="border-b">
        <td class="py-2 px-4"><?= $log['id'] ?></td>
        <td class="py-2 px-4"><?= $log['date'] ?></td>
        <td class="py-2 px-4"><?= $log['type'] ?></td>
        <td class="py-2 px-4"><?= $log['message'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include 'partials/footer.php'; ?>

