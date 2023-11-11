<?php

use \Emeset\Contracts\Http\Request;
use \Emeset\Contracts\Http\Response;
use \Emeset\Contracts\Container;
use \Emeset\Middleware;

/**
 * Middleware que gestiona l'autenticació
 *
 * @param \Emeset\Contracts\Http\Request $request petició HTTP
 * @param \Emeset\Contracts\Http\Response $response resposta HTTP
 * @param \Emeset\Contracts\Container $container  
 * @param callable $next  següent middleware o controlador.   
 * @return \Emeset\Contracts\Http\Response resposta HTTP
 */
function test($request, $response, $config, $next) :Response
{

    // aquest middleware no fa res pot servir de template der fer middlewares més útils.
    $response = Middleware::next($request, $response, $config, $next);
    return $response;
}
