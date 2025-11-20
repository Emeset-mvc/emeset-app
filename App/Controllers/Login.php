<?php

namespace App\Controllers;

use \Emeset\Contracts\Http\Request;
use \Emeset\Contracts\Http\Response;
use \Emeset\Contracts\Container;

/**
 * Controlador de login d'exemple del Framework Emeset
 * Framework d'exemple per a M07 Desenvolupament d'aplicacions web.
 * @author: Dani Prados dprados@cendrassos.net
 *
 * Carrega la pàgina de login
 *
 **/

class Login {

/**
 * ctrlLogin: Controlador que carrega  la pàgina de login
 *
 * @param $request contingut de la peticó http.
 * @param $response contingut de la response http.
 * @param array $config  paràmetres de configuració de l'aplicació
 *
 **/
public function login(Request $request, Response $response, Container $container) :Response
{
  // Comptem quantes vegades has visitat aquesta pàgina
  $error = $request->get("SESSION", "error");


  $response->set("error", $error);
  $response->setSession("error", "");

  $response->SetTemplate("login.php");

  return $response;
}

public function validarLogin(Request $request, Response $response, Container $container) :Response
{
    // Comptem quantes vegades has visitat aquesta pàgina
    $usuari = $request->get(INPUT_POST, "usuari");
    $clau = $request->get(INPUT_POST, "clau");
    $config = $container->get("config");


    if ($usuari === $config["login"]["usuari"] && $clau == $config["login"]["clau"]) {
        $response->setSession("usuari", $config["login"]["usuari"]);
        $response->setSession("logat", true);
        $response->redirect("location: /privat");
    } else {
        $response->setSession("error", "Usuari o clau incorrectes!");
        $response->setSession("logat", false);
        $response->redirect("location: /login");
    }

    return $response;
}

public function tancarSessio(Request $request, Response $response, Container $container) :Response
{
  $response->setSession("logat", false);
  $response->redirect("location: /");

  return $response;
}

}
