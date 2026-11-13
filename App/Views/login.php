<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/main.css">
  <title>Exemple de portada</title>
</head>
<body>
  <main class="page">
    <h1 class="page-title">Exemple de controlador del Framework Emeset</h1>
    <?php if ($error != "") { ?>
      <div class="alert alert--error" role="alert"><?= $error ?></div>
    <?php } ?>
    <div class="login-layout">
      <section class="login-card">
        <form class="login-form" action="/validar-login" method="post">
          <h2 class="login-title">Emeset - Exemple de login</h2>
          <div>
            <label for="usuari">Correu electrònic</label>
            <input type="text" name="usuari" id="usuari" class="form-control" placeholder="nom@centre.cat" required>
          </div>
          <div>
            <label for="clau">Contrasenya</label>
            <input type="password" name="clau" id="clau" class="form-control" placeholder="••••••••" required>
          </div>
          <button type="submit" class="button button--primary">Hola!</button>
        </form>
      </section>
    </div>
  </main>
  <script src="/js/bundle.js" defer></script>
</body>
</html>
