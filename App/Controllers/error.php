<?php

use \Emeset\Contracts\Http\Request;
use \Emeset\Contracts\Http\Response;
use \Emeset\Contracts\Container;

/**
 * Controlador de la pàgina d'error d'exemple del Framework Emeset
 * Framework d'exemple per a M07 Desenvolupament d'aplicacions web.
 * @author: Dani Prados dprados@cendrassos.net
 *
 * Carrega la portada
 *
 **/

/**
 * ctrlError: Controlador que carrega la pàgina d'error
 *
 * @param $request contingut de la petiicó http.
 * @param $response contingut de la response http.
 * @param $container  paràmetres de configuració de l'aplicació
 *
 **/
function ctrlError(Request $request, Response $response, Container $container) :Response
{

  $error = $request->get("SESSION", "error");
  $response->set("error", $error);
  $response->SetTemplate("error.php");

  return $response;
}
