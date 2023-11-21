<?php

namespace App\Commands;

class Config
{
    public function show($args, $output, $container)
    {
        $output->json($container->get("config"));
    }
}