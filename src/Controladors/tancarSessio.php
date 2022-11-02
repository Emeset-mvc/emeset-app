<?php

/**
 * Controlador que gestiona el procés de login
 * Framework d'exemple per a M07 Desenvolupament d'aplicacions web.
 * @author: Dani Prados dprados@cendrassos.net
 *
 * Comprova si l'usuari s'ha autentificat correctament
 *
 **/

/**
 * ctrlValidarLogin: Controlador que comprova si l'usuari s'ha autentificat
 * correctament
 *
 * @param $request contingut de la peticó http.
 * @param $response contingut de la response http.
 * @param array $config  paràmetres de configuració de l'aplicació
 *
 **/
function ctrlTancarSessio($request, $response, $config)
{
  $response->setSession("logat", false);
  $response->redirect("location: /");

  return $response;
}
