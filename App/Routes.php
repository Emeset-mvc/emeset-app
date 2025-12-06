<?php

namespace App;

use Emeset\Emeset;

class Routes
{

    public static function routes(Emeset $app): Emeset
    {
        $app->middleware([\App\Middleware\App::class, "execute"]);

        /* Definim les rutes de la nostra aplicació */
        $app->get("", [\App\Controllers\Portada::class, "index"]);
        $app->get("login",  [\App\Controllers\Login::class, "login"]);
        $app->post("validar-login", [\App\Controllers\Login::class, "validarLogin"]);
        $app->get("privat", [\App\Controllers\Privat::class, "privat"], ["auth"]);
        $app->get("tancar-sessio", [\App\Controllers\Login::class, "tancarSessio"], ["auth"]);

        $app->get("ajax", function ($request, $response) {
            $response->set("result", "ok");
            return $response;
        });

        $app->get("/hola/{id}", function ($request, $response) {
            $id = $request->getParam("id");
            $response->setBody("Hola {$id}!");
            return $response;
        });
        return $app;
    }
}
