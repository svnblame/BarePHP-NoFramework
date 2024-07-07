<?php

use KTS\src\Core\Session;
use KTS\src\Http\Forms\LoginForm;
use KTS\src\Core\Authenticator;

$email = trim(strip_tags(htmlspecialchars($_POST['email'])));
$password = trim(strip_tags(htmlspecialchars($_POST['password'])));

$form = new LoginForm();

if ($form->validate($email, $password)) {
    $auth = new Authenticator();

    try {
        if ($auth->attempt($email, $password)) {
            redirect('/');
        }

        $form->error('email', 'Authentication failed');
    } catch (Exception $e) {
        $auth->handleException($e);
    }
}

Session::flash('errors', $form->errors());

return redirect('/sessions');
