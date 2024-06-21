<?php declare(strict_types = 1);

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = require base_path('config/routes.php');

route($uri, $routes);