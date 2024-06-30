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

    public function get(string $uri, string $controller): void
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'GET',
        ];

        dump($this->routes);
    }

    public function post(string $uri, string $controller): void
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'POST',
        ];
    }

    public function patch(string $uri, string $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'PATCH',
        ];
    }

    public function put(string $uri, string $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'PUT',
        ];
    }

    public function delete(string $uri, string $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'DELETE',
        ];
    }

    #[NoReturn] protected function abort($code = 404): void
    {
        http_response_code($code);
        view("{$code}.view.php", ['heading' => Response::getMessage($code)]);
        die();
    }
}
