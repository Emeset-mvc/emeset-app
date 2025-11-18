<!doctype html>
<html lang="ca">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS (compilat dins main.css) -->
  <link rel="stylesheet" href="/main.css">

  <title><?=$app_config["app"]["name"]?></title>
</head>

<body>
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <h1 class="h1 mb-4 fw-bold">
          Exemple de controlador del Framework Emeset
        </h1>
        <a href="/privat" class="btn btn-warning me-2 mb-2">
          Accedeix a la zona privada
        </a>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col">
        <p class="mb-1"><?= $missatge ?></p>
        <p id="missatge"></p>
      </div>
    </div>
  </div>

  <script src="/js/bundle.js"></script>
</body>

</html>
