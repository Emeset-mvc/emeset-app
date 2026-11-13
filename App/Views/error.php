<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/main.css">
  <title>Exemple d'ús de sessions</title>
</head>
<body>
  <main class="page">
    <h1 class="page-title">Alguna cosa ha anat malament!</h1>
    <?php if (isset($error) && $error != "") { ?>
      <div class="alert alert--error" role="alert"><?= $error ?></div>
    <?php } ?>
    <p>Si has arribat aquí vol dir que alguna cosa ha fallat.</p>
  </main>
  <script src="/js/bundle.js" defer></script>
</body>
</html>
