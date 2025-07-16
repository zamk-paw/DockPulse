<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - DockPulse</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
  <div class="w-full max-w-md p-8 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4">Inscription</h1>
    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-700 p-2 rounded mb-4"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" class="space-y-4">
      <input name="username" type="text" placeholder="Nom d'utilisateur"
        class="w-full border px-3 py-2 rounded" required>
      <input name="email" type="email" placeholder="Email"
        class="w-full border px-3 py-2 rounded" required>
      <input name="password" type="password" placeholder="Mot de passe"
        class="w-full border px-3 py-2 rounded" required>
      <input name="password_confirm" type="password" placeholder="Confirmez le mot de passe"
        class="w-full border px-3 py-2 rounded" required>
      <button class="w-full bg-green-600 text-white px-3 py-2 rounded">S’inscrire</button>
    </form>
    <p class="text-sm mt-4">Déjà inscrit ? <a class="text-blue-600" href="/auth/login">Connectez‑vous</a></p>
  </div>
</body>
</html>

