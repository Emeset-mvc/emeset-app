<?php

/**
 * Middelware que gestiona l'autenticació
 *
 * @param petitcio $request
 * @param response $response
 * @param funcio $next  ha de ser el controlador
 * @param array $config  paràmetres de configuració de l'aplicació
 * @return result
 */
function auth($request, $response, $config, $next)
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
        $response = nextMiddleware($request, $response, $config, $next);
    } else {
        $response->redirect("location: /login");
    }
    return $response;
}
