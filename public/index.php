<?php

use Dotenv\Dotenv;
use KTS\src\Core\Router;

require __DIR__ . '/../vendor/autoload.php';

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/utils.php';

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$router = new Router();

$routes = require base_path('config/routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($method, $uri);
