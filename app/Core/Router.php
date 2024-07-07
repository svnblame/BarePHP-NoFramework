<?php

namespace KTS\src\Core;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use KTS\src\Core\Middleware\Middleware;

class Router
{
    protected array $routes = [];

    /**
     * @throws Exception
     */
    public function route(string $method, string $uri)
    {
        $appConfig = require base_path('/config/app.php');

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                if ($route['middleware']) Middleware::resolve($route['middleware']);

                return require base_path($appConfig['controller_dir'] . $route['controller']);
            }
        }

        $this->abort();
    }

    public function only($key): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    protected function add(string $method, string $uri, string $controller): Router
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
        ];

        return $this;
    }

    public function get(string $uri, string $controller): Router
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller): Router
    {
        return $this->add('POST', $uri, $controller);
    }

    public function patch(string $uri, string $controller): Router
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put(string $uri, string $controller): Router
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function delete(string $uri, string $controller): Router
    {
        return $this->add('DELETE', $uri, $controller);
    }

    #[NoReturn] protected function abort($code = 404): void
    {
        http_response_code($code);
        view("errors/{$code}.view.php", ['heading' => Response::getMessage($code)]);
        die();
    }
}
