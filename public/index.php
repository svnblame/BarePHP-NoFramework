<?php

use KTS\src\Core\Router;
use KTS\src\Core\Session;
use KTS\src\Core\ValidationException;

session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'app/Core/utils.php';

require base_path('bootstrap.php');

$router = new Router();

$routes = require base_path('config/routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($method, $uri);
} catch (ValidationException $e) {
    Session::flash('errors', $e->errors);
    Session::flash('old', $e->old);

    return redirect($router->previousUrl());
}

Session::unflash();
