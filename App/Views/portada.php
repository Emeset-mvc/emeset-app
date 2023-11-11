<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/main.css">

  <title><?=$app_config["app"]["name"]?></title>
</head>

<body>
  <div class="container mx-auto p-10">
    <div class="grid grid-cols-1 gap-4">
      <div>
        <h1 class="mb-4 text-xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Exemple de controlador del Framework Emeset</h1>
        <a href="/privat" class="focus:outline-none text-white bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 my-2">Accedeix a la zona privada</a>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-4 mt-10">
      <div class="text-base">
        <p><?= $missatge  ?></p>
        <p id="missatge"></p>
      </div>
    </div>
  </div>
  <script src="/js/bundle.js"></script>
</body>

</html>