<?php

$db = [
    'driver' => 'mysql',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix' => '',
];

if (defined('ENV_DEV')) {
    $db['host'] = 'localhost';
    $db['database'] = 'store';
    $db['username'] = 'root';
    $db['password'] = '';
} else {
    //Use Heroku environment variable for connecting to ClearDB
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $db['host'] = $url["host"];
    $db['database'] = substr($url["path"], 1);
    $db['username'] = $url["user"];
    $db['password'] = $url["pass"];

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
}

return $db;
