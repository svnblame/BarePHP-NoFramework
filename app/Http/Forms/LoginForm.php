<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    const AUTH_FAIL_MSG = 'Authentication failed';

    protected array $errors = [];

    public function __construct(public array $attributes = [])
    {
        $dbConfig = require(base_path('/config/database.php'));

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = self::AUTH_FAIL_MSG;
        }

        if (!Validator::string($attributes['password'], $dbConfig['password_char_min'], $dbConfig['password_char_max'])) {
            $this->errors['password'] = self::AUTH_FAIL_MSG ;
        }
    }

    /**
     * @throws ValidationException
     */
    public static function validate(array $attributes): LoginForm
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function failed(): bool
    {
        return (bool) count($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error(string $field, string $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function throw(): void
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }
}
