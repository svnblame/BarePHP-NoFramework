<?php

use JetBrains\PhpStorm\NoReturn;
use Core\Response;

function route($uri, $routes): void
{
    if (array_key_exists($uri, $routes)) {
        require base_path($routes[$uri]);
    } else {
        abort(); // 404 Not Found
    }
}

function dump($value, $die = false): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    if ($die) { die(); }
}

function urlIs($value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

#[NoReturn] function abort($code = 404): void
{
    http_response_code($code);
    view("{$code}.view.php", ['heading' => Response::getMessage($code)]);
    die();
}

function authorize($condition, $status = Response::FORBIDDEN): void
{
    if (! $condition) { abort($status); }
}

function base_path($path = ''): string
{
    return BASE_PATH . $path;
}

function view(string $path, array $attributes = []): void
{
    extract($attributes);
    require base_path('views/' . $path);
}
