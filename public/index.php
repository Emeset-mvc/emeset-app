<?php

/**
 * Front controler
 * Exemple de MVC per a M07 Desenvolupament d'aplicacions web en entorn de servidor.
 * Aquest Framework implementa el mínim per tenir un MVC per fer pràctiques
 * de M07.
 * @author: Dani Prados dprados@cendrassos.net
 * @version 0.1.0
 *
 * Punt d'netrada de l'aplicació exemple del Framework Emeset.
 * Per provar com funciona es pot executer php -S localhost:8000 a la carpeta public.
 * I amb el navegador visitar la url http://localhost:8000/
 *
 */

error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "../vendor/autoload.php";
include "../src/config.php";

include "../src/Controladors/portada.php";
include "../src/Controladors/error.php";
include "../src/Controladors/login.php";
include "../src/Controladors/validarlogin.php";
include "../src/Controladors/privat.php";
include "../src/Controladors/tancarSessio.php";
include "../src/Middleware/auth.php";
include "../src/Middleware/test.php";


/* Creem els diferents models */
$contenidor = new \Emeset\Container($config);

$app = new \Emeset\Emeset($contenidor);


$app->route("", "ctrlPortada");
$app->route("login", "ctrlLogin");
$app->route("validar-login", "ctrlValidarLogin");
$app->route("privat", "\Controladors\CtrlPrivat:privat", ["auth"]);
$app->route("tancar-sessio", "ctrlTancarSessio", ["auth"]);

$app->route("ajax", function ($request, $response) {
    $response->set("result", "ok");
    return $response;
});
$app->route(\Emeset\Routers\Router::DEFAULT_ROUTE, "ctrlError");

$app->execute();
