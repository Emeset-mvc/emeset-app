<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/main.css">

  <title>Exemple d'us de sessions</title>
</head>

<body>
  <div class="container mx-auto p-10">
    <div class="grid grid-cols-1 gap-4">
      <div>
        <h1 class="mb-4 text-xl text-red-700 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Alguna cosa ha anat malament!</h1>
      </div>
    </div>

    <?php if (isset($error) && $error != "") { ?>
      <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        <?= $error ?>
      </div>
    <?php } ?>

    <div class="grid grid-cols-1 gap-4">
      <div>
        <p class="text-base">Si has arribat aquí vol dir que alguna cosa ha fallat.</p>
      </div>
    </div>

  </div>
  <script src="/js/bundle.js"></script>
</body>

</html>