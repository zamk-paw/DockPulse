<!-- app/views/auth/register.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - DockPulse</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">DockPulse - Inscription</h1>
    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>
    <form action="/auth/register" method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Nom d'utilisateur</label>
        <input type="text" name="username" required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" name="password" required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
        <input type="password" name="password_confirm" required
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
      </div>
      <button type="submit"
        class="w-full py-2 px-4 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        S'inscrire
      </button>
    </form>
    <p class="mt-6 text-center text-sm text-gray-600">
      Déjà un compte ? <a href="/auth/login" class="text-indigo-600 hover:text-indigo-800">Connecte-toi ici</a>.
    </p>
  </div>
</body>
</html>

