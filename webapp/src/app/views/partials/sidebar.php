<aside class="bg-gray-800 text-white w-64 flex-shrink-0">
  <div class="p-4 border-b border-gray-700">
    <h2 class="text-lg font-bold tracking-wide flex items-center space-x-2">
      <span>📂</span><span>Menu</span>
    </h2>
  </div>
  <nav class="p-4 space-y-2">
    <!-- Dashboard -->
    <a href="/dashboard"
       class="flex items-center px-3 py-2 rounded-md transition-colors hover:bg-gray-700 <?php echo ($_SERVER['REQUEST_URI'] === '/dashboard') ? 'bg-gray-700 font-semibold' : ''; ?>">
      🏠 <span class="ml-2">Accueil</span>
    </a>

    <!-- Logs -->
    <a href="/logs"
       class="flex items-center px-3 py-2 rounded-md transition-colors hover:bg-gray-700 <?php echo ($_SERVER['REQUEST_URI'] === '/logs') ? 'bg-gray-700 font-semibold' : ''; ?>">
      📋 <span class="ml-2">Logs</span>
    </a>

    <!-- Applications (visible uniquement pour admin) -->
    <?php if (($userRole ?? 'guest') === 'admin'): ?>
      <a href="/application"
         class="flex items-center px-3 py-2 rounded-md transition-colors hover:bg-gray-700 <?php echo (str_starts_with($_SERVER['REQUEST_URI'], '/application')) ? 'bg-gray-700 font-semibold' : ''; ?>">
        ⚙️ <span class="ml-2">Applications</span>
      </a>
    <?php endif; ?>

    <!-- Administration -->
    <?php if (($userRole ?? 'guest') === 'admin'): ?>
      <div class="pt-2 border-t border-gray-700">
        <a href="/admin"
           class="flex items-center px-3 py-2 rounded-md transition-colors hover:bg-gray-700 <?php echo ($_SERVER['REQUEST_URI'] === '/admin') ? 'bg-gray-700 font-semibold' : ''; ?>">
          🔧 <span class="ml-2">Administration</span>
        </a>
      </div>
    <?php endif; ?>
  </nav>
</aside>

<main class="flex-1 p-6 bg-gray-50">
