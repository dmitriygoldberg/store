<?php

$db = require __DIR__ . '/db.php';
$routes = require __DIR__ . '/routes.php';
$aliases = require __DIR__ . '/aliases.php';
$params = require __DIR__ . '/params.php';

$config = [
    'db' => $db,
    'routes' => $routes,
    'aliases' => $aliases,
    'params' => $params,
];

return $config;