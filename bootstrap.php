<?php

use Dotenv\Dotenv;
use KTS\src\Core\App;
use KTS\src\Core\Container;
use KTS\src\Core\Database;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$container = new Container();

$container->bind('Core\Database', function () {
    $dbConfig = require base_path('config/database.php');

    return new Database($dbConfig, $dbConfig['user'], $dbConfig['pass']);
});

App::setContainer($container);
