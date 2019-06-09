<?php
session_start();

//define('ENV_DEV', true);

$loader = require_once 'vendor/autoload.php';
$config = require __DIR__ . '/config/config.php';

(new App($config))->run();