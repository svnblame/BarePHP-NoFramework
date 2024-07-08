<?php

namespace Core;

use Exception;

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
        Session::destroy();
    }
}
