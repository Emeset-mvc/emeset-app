<?php

return [
    /* configuració de connexió a la base dades */
    /* Path on guardarem el fitxer sqlite */
    "sqlite" => [
        "path" => Emeset\Env::get("sqlite_path", "../"),
        "name" => Emeset\Env::get("sqlite_name", "db.sqlite")
    ],
    /* Nom de la cookie */
    "cookie" => [
        "name" => Emeset\Env::get("cookie_name", 'visites')
    ],
    "login" => [
        "usuari" => Emeset\Env::get("login_usuari", "dani"),
        "clau" => Emeset\Env::get("login_clau", "1234")
    ],
    "app" => [
        "name" => Emeset\Env::get("app_name", "Emeset demo"),
        "version" => Emeset\Env::get("app_version", "0.2.5")
    ]
];