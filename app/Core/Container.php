<?php

namespace KTS\src\Core;

class Container
{
    protected array $bindings = [];

    public function bind(string $key, callable $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    /**
     * @throws \Exception
     */
    public function resolve(string $key): mixed
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception("The binding '{$key}' does not exist.");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}
