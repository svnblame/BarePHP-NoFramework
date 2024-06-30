<?php

namespace KTS\src\Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    protected array $routes = [];

    public function route(string $method, string $uri)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    protected function add(string $method, string $uri, string $controller): void
    {
        $this->routes[] = compact('method', 'uri', 'controller');
    }

    public function get(string $uri, string $controller): void
    {
        $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller): void
    {
        $this->add('POST', $uri, $controller);
    }

    public function patch(string $uri, string $controller)
    {
        $this->add('PATCH', $uri, $controller);
    }

    public function put(string $uri, string $controller)
    {
        $this->add('PUT', $uri, $controller);
    }

    public function delete(string $uri, string $controller)
    {
        $this->add('DELETE', $uri, $controller);
    }

    #[NoReturn] protected function abort($code = 404): void
    {
        http_response_code($code);
        view("{$code}.view.php", ['heading' => Response::getMessage($code)]);
        die();
    }
}
