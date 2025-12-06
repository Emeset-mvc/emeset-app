<?php

/**
 * Front controler
 * Exemple de MVC per a M613 Desenvolupament d'aplicacions web en entorn de servidor.
 * Aquest Framework implementa el mínim per tenir un MVC per fer pràctiques
 * de M613.
 * @author: Dani Prados dprados@cendrassos.net
 * @version 0.5.0
 *
 * Punt d'entrada de l'aplicació exemple del Framework Emeset.
 * Per provar com funciona es pot executer php -S localhost:8000 a la carpeta public.
 * I amb el navegador visitar la url http://localhost:8000/
 *
 */

use \Emeset\Contracts\Routers\Router;

include "../vendor/autoload.php";
include "../App/Controllers/error.php";
include "../App/Middleware/auth.php";

/* Creem els container */
$contenidor = new \App\Container(__DIR__ . "/../App/config.php");

/* Creem l'aplicació i li afegim el middleware */
$app = new \Emeset\Emeset($contenidor);
require __DIR__ . '/../App/routes.php';
$app->execute();
