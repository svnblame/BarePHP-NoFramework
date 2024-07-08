<?php

use KTS\src\Http\Forms\LoginForm;
use KTS\src\Core\Authenticator;

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
    $auth->handleException($e);
}

redirect('/');
