<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/main.css">
  <title><?=$app_config["app"]["name"]?></title>
</head>
<body>
  <main class="page">
    <h1 class="page-title">Exemple de controlador del Framework Emeset</h1>
    <a href="/privat" class="button">Accedeix a la zona privada</a>
    <div class="content">
      <p><?= $missatge ?></p>
      <p id="missatge"></p>
    </div>
  </main>
  <script src="/js/bundle.js" defer></script>
</body>
</html>
