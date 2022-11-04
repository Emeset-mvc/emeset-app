<?php

/**
 * Controlador de la zona privada de l'exemple del Framework Emeset
 * Framework d'exemple per a M07 Desenvolupament d'aplicacions web.
 * @author: Dani Prados dprados@cendrassos.net
 *
 * Carrega la zona privada de l'exemple.
 *
 **/

namespace App\Controllers;

class Privat
{

    public $contenidor;

    public function __construct($contenidor)
    {
        $this->contenidor = $contenidor;
    }

    /**
     * ctrlPortada: Controlador que carrega  la zona privada de l'exemple.
     *
     * @param \Emeset\Http\Request $request contingut de la peticó http.
     * @param \Emeset\Http\Response $response contingut de la response http.
     * @param \Emeset\Container  $container contenidor de dependències.
     *
     **/
    public function privat($request, $response, $container)
    {
        // Comptem quantes vegades has visitat aquesta pàgina
        $visites = $request->get(INPUT_COOKIE, "visites-privades");
        if (!is_null($visites)) {
            $visites = (int)$visites + 1;
        } else {
            $visites = 1;
        }
        $response->setcookie("visites-privades", $visites, strtotime("+1 month"));

        $missatge = "";
        if ($visites == 1) {
            $missatge = "Benvingut! Aquesta és la primera pàgina que visites la zona privada!";
        } else {
            $missatge = "Hola! Ja has visitat {$visites} pàgines privades d'aquesta web!";
        }


        $response->set("missatge", $missatge);
        $response->SetTemplate("privat.php");

        return $response;
    }
}
