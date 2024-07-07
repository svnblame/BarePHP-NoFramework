<?php

namespace KTS\src\Core;

use Exception;
use JetBrains\PhpStorm\NoReturn;

class Authenticator
{
    /**
     * @throws Exception
     */
    public function attempt(string $email, string $password): bool
    {
        $user = App::resolve('Core\Database')
            ->query('select `id`, `email`, `password`, `first_name`, `last_name` from users where email = :email', [
                'email' => $email
        ])->find();

        if ($user) {
            // Verify User provided password
            if (password_verify($password, $user['password'])) {
                $this->login($user);

                return true;
            }
        }

        return false;
    }

    /**
     * @throws Exception
     */
    public function login(array $user): void
    {
        App::resolve('Core\Database')->query("update `users` set `last_login_at` = now(), `last_login_from` = '{$_SERVER['REMOTE_ADDR']}' where id = :id", [
            'id' => $user['id']
        ]);

        $_SESSION['user'] = [
            'logged_in' => true,
            'id' => $user['id'],
            'email' => $user['email'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
        ];

        session_regenerate_id(true);
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        $cookieParams = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'], $cookieParams['httponly']);
    }

    #[NoReturn] public function handleException(Exception $e): void
    {
        error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage() . PHP_EOL . '**Trace: ' . $e->getTraceAsString());
        abort(503);
    }
}
