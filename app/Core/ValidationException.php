<?php

namespace Core;

use Exception;

class ValidationException extends Exception
{
    public readonly array $errors;

    public readonly array $old;

    /**
     * @throws ValidationException
     */
    public static function throw(array $errors, array $old)
    {
        $instance = new static;

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}