<?php

/**
 * Middelware que no fa res
 *
 * @param petitcio $request
 * @param response $response
 * @param funcio $next  ha de ser el controlador
 * @param array $config  paràmetres de configuració de l'aplicació
 * @return result
 */
function test($request, $response, $config, $next)
{

    // aquest middleware no fa res pot servir de template der fer middlewares més útils.
    $response = nextMiddleware($request, $response, $config, $next);
    return $response;
}
