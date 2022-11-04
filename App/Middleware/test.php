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
function test($request, $response, $config, $next)
{

    // aquest middleware no fa res pot servir de template der fer middlewares més útils.
    $response = nextMiddleware($request, $response, $config, $next);
    return $response;
}
