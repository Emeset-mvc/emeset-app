<?php

/**
 * Controlador de login d'exemple del Framework Emeset
 * Framework d'exemple per a M07 Desenvolupament d'aplicacions web.
 * @author: Dani Prados dprados@cendrassos.net
 *
 * Carrega la pàgina de login
 *
 **/

/**
 * ctrlLogin: Controlador que carrega  la pàgina de login
 *
 * @param $request contingut de la peticó http.
 * @param $response contingut de la response http.
 * @param array $config  paràmetres de configuració de l'aplicació
 *
 **/
function ctrlLogin($request, $response, $config)
{
  // Comptem quantes vegades has visitat aquesta pàgina
  $error = $request->get("SESSION", "error");


  $response->set("error", $error);
  $response->setSession("error", "");

  $response->SetTemplate("login.php");

  return $response;
}
