<?php

/**
 * Front controler
 * Exemple de MVC per a M613 Desenvolupament d'aplicacions web en entorn de servidor.
 * Aquest Framework implementa el mínim per tenir un MVC per fer pràctiques
 * de M613.
 * @author: Dani Prados dprados@cendrassos.net
 * @version 0.5.0
 *
 * Punt d'netrada de l'aplicació exemple del Framework Emeset.
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
$app->middleware([\App\Middleware\App::class, "execute"]);

/* Definim les rutes de la nostra aplicació */
$app->route("", [\App\Controllers\Portada::class, "index"]);
$app->route("login",  [\App\Controllers\Login::class, "login"]);
$app->route("validar-login", [\App\Controllers\Login::class, "validarLogin"]);
$app->route("privat", [\App\Controllers\Privat::class, "privat"], ["auth"]);
$app->route("tancar-sessio", [\App\Controllers\Login::class, "tancarSessio"], ["auth"]);

$app->route("ajax", function ($request, $response) {
    $response->set("result", "ok");
    return $response;
});

$app->route("/hola/{id}", function ($request, $response) {
    $id = $request->getParam("id");
    $response->setBody("Hola {$id}!");
    return $response;
});

$app->route(Router::DEFAULT_ROUTE, "ctrlError");

$app->execute();
