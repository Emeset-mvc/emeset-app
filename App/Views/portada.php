<!doctype html>
<html lang="ca">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="/js/bundle.js"></script>
</body>

</html>
