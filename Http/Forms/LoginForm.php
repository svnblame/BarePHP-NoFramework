<?php

namespace KTS\src\Http\Forms;

use KTS\src\Core\Validator;

class LoginForm
{
    const AUTH_FAIL_MSG = 'Authentication failed';

    protected array $errors = [];

    public function validate(string $email, string $password): bool
    {
        $dbConfig = require(base_path('/config/database.php'));

        if (!Validator::email($email)) {
            $this->errors['email'] = self::AUTH_FAIL_MSG;
        }

        if (!Validator::string($password, $dbConfig['password_char_min'], $dbConfig['password_char_max'])) {
            $this->errors['password'] = self::AUTH_FAIL_MSG ;
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error(string $field, string $message): void
    {
        $this->errors[$field] = $message;
    }
}
