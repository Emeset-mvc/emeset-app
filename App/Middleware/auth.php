<?php

use \Emeset\Contracts\Http\Request;
use \Emeset\Contracts\Http\Response;
use \Emeset\Contracts\Container;

/**
 * Middleware que gestiona l'autenticació
 *
 * @param \Emeset\Contracts\Http\Request $request petició HTTP
 * @param \Emeset\Contracts\Http\Response $response resposta HTTP
 * @param \Emeset\Contracts\Container $container  
 * @param callable $next  següent middleware o controlador.   
 * @return \Emeset\Contracts\Http\Response resposta HTTP
 */
function auth(Request $request, Response $response, Container $container, $next) : Response
{

    $usuari = $request->get("SESSION", "usuari");
    $logat = $request->get("SESSION", "logat");

    if (!isset($logat)) {
        $usuari = "";
        $logat = false;
    }

    $response->set("usuari", $usuari);
    $response->set("logat", $logat);

    // si l'usuari està logat permetem carregar el recurs
    if ($logat) {
        $response = \Emeset\Middleware::next($request, $response, $container, $next);
    } else {
        $response->redirect("location: /login");
    }
    return $response;
}
