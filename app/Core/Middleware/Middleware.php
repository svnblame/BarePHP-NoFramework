<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class,
    ];

    public static function resolve(string $key): void
    {
        if (! $key) return;

        $middleware = static::MAP[$key] ?? false;

        if (! $middleware) {
            throw new \Exception("Not matching middleware found for key '{$middleware}'");
        }

        (new $middleware)->handle();
    }
}