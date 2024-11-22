<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link rel="stylesheet" href="/main.css">

  <title>Exemple de portada</title>
</head>

<body class="dark:bg-gray-600">
  <div class="container mx-auto p-10">
    <div class="grid grid-cols-1 gap-4">
      <div>
        <h1 class="mb-4 text-xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Exemple de controlador del Framework Emeset</h1>
      </div>
    </div>

    <?php if ($error != "") { ?>
      <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        <?= $error ?>
      </div>
    <?php } ?>

    <div class="grid grid-cols-12">
      <div class="col-start-5 col-span-4">
        <div class="p-4 w-full max-w-sm bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
          <form class="space-y-6" action="/validar-login" method="post">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Emeset - Exemple de login</h5>
            <div>
              <label for="usuari" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
              <input type="text" name="usuari" id="usuari" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
            </div>
            <div>
              <label for="clau" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
              <input type="password" name="clau" id="clau" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>

            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Hola!</button>

          </form>
        </div>


      </div>
    </div>
  </div>
  <script src="/js/bundle.js"></script>
</body>

</html>