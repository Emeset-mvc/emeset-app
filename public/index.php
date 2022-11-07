<?php

/**
 * Front controler
 * Exemple de MVC per a M07 Desenvolupament d'aplicacions web en entorn de servidor.
 * Aquest Framework implementa el mínim per tenir un MVC per fer pràctiques
 * de M07.
 * @author: Dani Prados dprados@cendrassos.net
 * @version 0.1.5
 *
 * Punt d'netrada de l'aplicació exemple del Framework Emeset.
 * Per provar com funciona es pot executer php -S localhost:8000 a la carpeta public.
 * I amb el navegador visitar la url http://localhost:8000/
 *
 */

error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "../vendor/autoload.php";
include "../App/config.php";

include "../App/Controllers/portada.php";
include "../App/Controllers/error.php";
include "../App/Controllers/login.php";
include "../App/Controllers/validarlogin.php";
//include "../App/Controllers/privat.php";
include "../App/Controllers/tancarSessio.php";
include "../App/Middleware/auth.php";
include "../App/Middleware/test.php";


/* Creem els diferents models */
$contenidor = new \App\Container($config);

$app = new \Emeset\Emeset($contenidor);


$app->route("", "ctrlPortada");
$app->route("login", "ctrlLogin");
$app->route("validar-login", "ctrlValidarLogin");
$app->route("privat", "\App\Controllers\Privat:privat", ["auth"]);
$app->route("tancar-sessio", "ctrlTancarSessio", ["auth"]);

$app->route("ajax", function ($request, $response) {
    $response->set("result", "ok");
    return $response;
});

$app->route("/hola/{id}", function ($request, $response) {
    $id = $request->getParam("id");
    $response->setBody("Hola {$id}!");
    return $response;
});

$app->route(\Emeset\Routers\Router::DEFAULT_ROUTE, "ctrlError");

$app->execute();
