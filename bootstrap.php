<?php

use Dotenv\Dotenv;
use Core\App;
use Core\Container;
use Core\Database;

require BASE_PATH . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$container = new Container();

$container->bind('Core\Database', function () {
    $dbConfig = require base_path('config/database.php');

    return new Database($dbConfig, $dbConfig['user'], $dbConfig['pass']);
});

App::setContainer($container);
