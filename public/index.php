<?php

use Core\Router;
use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . '/../';

session_start();

require BASE_PATH . 'bootstrap.php';

require BASE_PATH . 'app/Core/utils.php';

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
