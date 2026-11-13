<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestedFile = __DIR__ . $path;

if ($path !== '/' && is_file($requestedFile)) {
    return false;
}

require __DIR__ . '/index.php';
