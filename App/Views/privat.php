<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/main.css">
  <title>Exemple de zona privada</title>
</head>
<body>
  <main class="page">
    <h1 class="page-title">Exemple de zona privada del Framework Emeset</h1>
    <a href="/" class="button">Accedeix a la zona pública</a>
    <a href="/tancar-sessio" class="button button--danger">Tanca la sessió de <?= $usuari ?></a>
    <div class="content"><p><?= $missatge ?></p></div>
  </main>
  <script src="/js/bundle.js" defer></script>
</body>
</html>
