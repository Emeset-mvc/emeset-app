<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link rel="stylesheet" href="/main.css">

  <title>Exemple de portada</title>
</head>

<body>
  <main class="page">
    <h1 class="page-title">Exemple de controlador del Framework Emeset</h1>

    <?php if ($error != "") { ?>
      <div class="alert alert--error" role="alert">
        <?= $error ?>
      </div>
    <?php } ?>

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
</body>

</html>
