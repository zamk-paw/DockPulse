<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - DockPulse</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-lg">
    <!-- Logo / Titre -->
    <div class="flex flex-col items-center mb-6">
      <div class="w-16 h-16 bg-indigo-600 text-white flex items-center justify-center rounded-full shadow-md">
        <span class="text-2xl">🐳</span>
      </div>
      <h1 class="text-2xl font-extrabold mt-4 text-gray-800">DockPulse</h1>
      <p class="text-gray-500">Connexion à votre compte</p>
    </div>

    <!-- Message d'erreur -->
    <?php if (!empty($error)): ?>
      <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded mb-4 text-sm">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <!-- Formulaire -->
    <form method="post" class="space-y-5">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
        <input name="email" type="email" placeholder="exemple@mail.com"
          class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
        <input name="password" type="password" placeholder="••••••••"
          class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
      </div>

      <button
        class="w-full bg-indigo-600 hover:bg-indigo-700 transition-colors text-white font-medium px-4 py-2 rounded-lg shadow-md">
        Se connecter
      </button>
    </form>

    <!-- Lien d'inscription -->
    <p class="text-sm text-center mt-6 text-gray-600">
      Pas de compte ? 
      <a class="text-indigo-600 font-medium hover:underline" href="/auth/register">Inscrivez‑vous</a>
    </p>
  </div>

</body>
</html>

