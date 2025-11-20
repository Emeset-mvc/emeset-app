<!doctype html>
<html lang="ca">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="/main.css">

  <title>Exemple d'ús de sessions</title>
</head>

<body>
  <div class="container py-5">

    <div class="row">
      <div class="col">
        <h1 class="fw-bold text-danger mb-4">Alguna cosa ha anat malament!</h1>
      </div>
    </div>

    <?php if (isset($error) && $error != "") { ?>
      <div class="alert alert-danger" role="alert">
        <?= $error ?>
      </div>
    <?php } ?>

    <div class="row">
      <div class="col">
        <p>Si has arribat aquí vol dir que alguna cosa ha fallat.</p>
      </div>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="/js/bundle.js"></script>
</body>

</html>
