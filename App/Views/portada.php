<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/main.css">

  <title><?=$app_config["app"]["name"]?></title>
</head>

<body>
  <main class="page">
    <h1 class="page-title">Exemple de controlador del Framework Emeset</h1>
    <a href="/privat" class="button">Accedeix a la zona privada</a>

    <div class="content">
      <p><?= $missatge  ?></p>
      <p id="missatge"></p>
    </div>
  </main>
  <script type="module" src="/js/bundle.js"></script>
</body>

</html>
