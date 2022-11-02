<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <title>Exemple de portada</title>
</head>

<body>
  <div class="container">
    <div class="row mt-1 mb-3">
      <div class="col">
        <h1>Exemple de controlador del Framework Emeset</h1>
      </div>
    </div>

    <?php if ($error != "") { ?>
      <div class="alert alert-danger" role="alert">
        <?= $error ?>
      </div>
    <?php } ?>

    <div class="row justify-content-md-center">
      <div class="col-5  p-3">
        <div class="card text-white bg-info mb-3">
          <div class="card-header">Emeset - Exemple de login</div>
          <div class="card-body">
            <h5 class="card-title">Hola!</h5>
            <p class="card-text">
            <form action="/validar-login" method="post">
              <input type="hidden" name="r" value="validar-login">

              <div class="form-group">
                <label for="inputUsuari">Abans d'entrar que et sembla si t'identifiques?</label>
                <input name="usuari" type="text" class="form-control" id="inputUsuari" value="<?= $usuari; ?>">

              </div>
              <div class="form-group">
                <label for="inputclau">Paraula clau *</label>
                <input name="clau" type="password" class="form-control" id="inputclau">
              </div>
              <button type="submit" class="btn btn-primary">Hola!</button>
            </form>
            </p>
          </div>
        </div>
      </div>
    </div>


  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>