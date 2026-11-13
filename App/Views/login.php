<!doctype html>
<html lang="ca">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="/main.css">

  <title>Exemple de portada</title>
</head>

<<<<<<< HEAD
<body class="bg-light">
  <div class="container py-5">

    <div class="row">
      <div class="col text-center">
        <h1 class="fw-bold mb-4">Exemple de controlador del Framework Emeset</h1>
      </div>
    </div>

    <?php if ($error != "") { ?>
      <div class="alert alert-danger text-center" role="alert">
=======
<body>
  <main class="page">
    <h1 class="page-title">Exemple de controlador del Framework Emeset</h1>

    <?php if ($error != "") { ?>
      <div class="alert alert--error" role="alert">
>>>>>>> 00608db (Canvis frontend curs 26/27)
        <?= $error ?>
      </div>
    <?php } ?>

<<<<<<< HEAD
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">

            <form action="/validar-login" method="post">

              <h5 class="mb-4 text-center fw-semibold">Emeset - Exemple de login</h5>

              <div class="mb-3">
                <label for="usuari" class="form-label">Correu electrònic</label>
                <input type="text" name="usuari" id="usuari" class="form-control" placeholder="nom@centre.cat" required>
              </div>

              <div class="mb-4">
                <label for="clau" class="form-label">Contrasenya</label>
                <input type="password" name="clau" id="clau" class="form-control" placeholder="••••••••" required>
              </div>

              <button type="submit" class="btn btn-primary w-100">
                Hola!
              </button>

            </form>

          </div>
        </div>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="/js/bundle.js"></script>
=======
    <div class="login-layout">
        <section class="login-card">
          <form class="login-form" action="/validar-login" method="post">
            <h2 class="login-title">Emeset - Exemple de login</h2>
            <div>
              <label for="usuari">Your email</label>
              <input type="text" name="usuari" id="usuari" class="form-control" placeholder="name@company.com" required>
            </div>
            <div>
              <label for="clau">Your password</label>
              <input type="password" name="clau" id="clau" placeholder="••••••••" class="form-control" required>
            </div>

            <button type="submit" class="button button--primary">Hola!</button>

          </form>
        </section>

    </div>
  </main>
  <script type="module" src="/js/bundle.js"></script>
>>>>>>> 00608db (Canvis frontend curs 26/27)
</body>

</html>
