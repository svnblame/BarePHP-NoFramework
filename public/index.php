<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/utils.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

require base_path('Core/router.php');
