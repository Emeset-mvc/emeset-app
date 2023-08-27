<?php

/**
 * Middleware que gestiona l'autenticació
 *
 * @param \Emeset\Http\Request $request petició HTTP
 * @param \Emeset\Http\Response $response resposta HTTP
 * @param \Emeset\Container $container  
 * @param callable $next  següent middleware o controlador.   
 * @return \Emeset\Http\Response resposta HTTP
 */
function auth(\Emeset\Http\Request $request, \Emeset\Http\Response $response, \Emeset\Container $container, $next)
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
