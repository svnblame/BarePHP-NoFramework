<?php

namespace Http\Controllers\Sessions;

use Core\Session;
use Exception;
use Http\Forms\LoginForm;
use Core\Authenticator;

$form = LoginForm::validate($attributes = [
    'email' => trim(strip_tags(htmlspecialchars($_POST['email']))),
    'password' => trim(strip_tags(htmlspecialchars($_POST['password']))),
]);

$auth = new Authenticator();

$loggedIn = $auth->attempt(
    $attributes['email'],
    $attributes['password']
);

try {
    if (! $loggedIn) {
        $form->error(
            'email', 'Authentication failed'
        )->throw();
    }
} catch (Exception $e) {
    Session::flash('errors', $e->errors);
    Session::flash('old', $e->old);

    return redirect('/sessions');
}

redirect('/');
