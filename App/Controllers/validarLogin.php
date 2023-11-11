<?php

use \Emeset\Contracts\Http\Request;
use \Emeset\Contracts\Http\Response;
use \Emeset\Contracts\Container;

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
 * @param $container  paràmetres de configuració de l'aplicació
 *
 **/
function ctrlValidarLogin(Request $request, Response $response, Container $container) :Response
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
