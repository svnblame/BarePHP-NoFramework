<?php

// check that the provided credentials match
use KTS\src\Core\App;
use KTS\src\Http\Forms\LoginForm;
//use KTS\src\Core\Validator;

try {
    $db = App::resolve('Core\Database');
} catch (Exception $e) {
    error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage());
    abort(503);
}

$dbConfig = $db::config();

$email = trim(strip_tags(htmlspecialchars($_POST['email'])));
$password = trim(strip_tags(htmlspecialchars($_POST['password'])));

$form = new LoginForm();

if (! $form->validate($email, $password)) {
    view('sessions/create.view.php', [
        'errors' => $form->errors(),
    ]);
}

// Validation has passed, now ensure the account exists
$user = $db->query('select `id`, `email`, `password`, `first_name`, `last_name` from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    // Verify User provided password
    if (password_verify($password, $user['password'])) {
        // if they match, log them in
        $db->query("update `users` set `last_login_at` = now(), `last_login_from` = '{$_SERVER['REMOTE_ADDR']}' where id = :id", [
            'id' => $user['id']
        ]);

        login($user);

        header('Location: /');
        exit();
    }
}

$errors['password'] = 'Authentication failed';
view('sessions/create.view.php', ['errors' => $errors]);