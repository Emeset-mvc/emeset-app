<?php
require_once __DIR__ . "/vendor/autoload.php";

/*
Canvi que s'ha de fer al constructor del container per poder fer servir el cli.

        $isCLI = (php_sapi_name() == 'cli');
        if ($isCLI) {
            $projectRootPath = getcwd();
        } else {
            $projectRootPath = dirname(getcwd());
        }
*/

$container = new \Emeset\Container(__DIR__ . "/App/config.php");

$cli = $container["cli"]; //new App\Cli\Cli($argv, new App\Cli\Parser($argv, new \Garden\Cli\Cli()) , new App\Cli\Output(new \League\CLImate\CLImate()), new \Emeset\Caller($container), $container);

$cli->addCommand("example:cli", function ($args, $output, $container) {
    $output->warning("Creant la base de dades...");
    $output->success("Base de dades creada correctament");
    $output->error("Base de dades creada correctament");
    $output->table([
        ["id" => 1, "name" => "Dani"],
        ["id" => 2, "name" => "Pep"],
        ["id" => 3, "name" => "Joan"],
    ]);

    $output->error()->bold()->echo("Hola");

    $output->br();
    $output->info()->border()->error()->echo("Hola")->success()->border();
   
}, "Exemple de les opcions del cli");

$cli->addCommand("example:table", function ($args, $output, $container) {
    
    $output->table([
        ["id" => 1, "name" => "Dani"],
        ["id" => 2, "name" => "Pep"],
        ["id" => 3, "name" => "Joan"],
    ]);

   
}, "Exemple de com mostrar la informació de la taula especificada");

$cli->addCommand("config:show", [App\Commands\Config::class, "show"], "Mostra la configuració de l'aplicació");


$cli->run();