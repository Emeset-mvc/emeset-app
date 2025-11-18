<!doctype html>
<html lang="ca">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="/main.css">

  <title>Exemple de zona privada</title>
</head>

<body>
  <div class="container py-5">

    <div class="row">
      <div class="col">
        <h1 class="fw-bold mb-4">Exemple de zona privada del Framework Emeset</h1>

        <a href="/" class="btn btn-warning me-2 mb-2">
          Accedeix a la zona pública
        </a>

        <a href="/tancar-sessio" class="btn btn-danger mb-2">
          Tanca la sessió de <?= $usuari ?>
        </a>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col">
        <p><?= $missatge ?></p>
      </div>
    </div>

  </div>

  <script src="/js/bundle.js"></script>
</body>

</html>
