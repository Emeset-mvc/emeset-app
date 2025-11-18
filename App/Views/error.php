<!doctype html>
<html lang="ca">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

  <script src="/js/bundle.js"></script>
</body>

</html>
