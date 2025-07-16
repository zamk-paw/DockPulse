<aside class="bg-gray-800 text-white w-64 p-4 space-y-4">
  <a href="/dashboard" class="block px-3 py-2 rounded hover:bg-gray-700">🏠 Accueil</a>
  <a href="/logs" class="block px-3 py-2 rounded hover:bg-gray-700">📋 Logs</a>
  <a href="/application" class="block px-3 py-2 rounded hover:bg-gray-700">⚙️ Applications</a>
  <?php if (($userRole ?? 'guest') === 'admin'): ?>
    <a href="/admin" class="block px-3 py-2 rounded hover:bg-gray-700">🔧 Administration</a>
  <?php endif; ?>
</aside>
<main class="flex-1 p-6">

