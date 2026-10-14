<?php

require_once __DIR__ . "/vendor/autoload.php";

$container = new \Emeset\Container(__DIR__ . "/App/config.php");
$cli = $container["cli"];

// Executa l'exemple des diferents tipus de sortida:
// php emeset.php example:output
$cli->addCommand("example:output", function ($args, $output, $container): void {
    $output->info("Exemple de sortides de la CLI");
    $output->warning("Aquest missatge és un avís.");
    $output->success("Aquest missatge indica que l'operació ha acabat correctament.");
    $output->error("Aquest missatge mostra com es presenta un error.");

    $output->br();
    $output->error()->bold()->echo("Text amb format");
    $output->info()->border()->echo("Text informatiu amb marc");
}, "Mostra exemples de missatges i formats de sortida");

// Executa l'exemple de taula:
// php emeset.php example:table
$cli->addCommand("example:table", function ($args, $output, $container): void {
    $output->table([
        ["id" => 1, "name" => "Dani"],
        ["id" => 2, "name" => "Pep"],
        ["id" => 3, "name" => "Joan"],
    ]);
}, "Mostra una taula amb dades d'exemple");

$cli->addCommand(
    "config:show",
    [App\Commands\Config::class, "show"],
    "Mostra la configuració de l'aplicació"
);

$cli->run();
