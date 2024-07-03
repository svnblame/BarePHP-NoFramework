<?php

use KTS\src\Core\Router;

session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'app/Core/utils.php';

require base_path('bootstrap.php');

$router = new Router();

$routes = require base_path('config/routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($method, $uri);
