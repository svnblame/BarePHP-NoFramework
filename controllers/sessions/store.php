<?php

// check that the provided credentials match
use KTS\src\Core\App;
use KTS\src\Core\Validator;

try {
    $db = App::resolve('Core\Database');
} catch (Exception $e) {
    error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage());
    abort(503);
}

$dbConfig = $db::config();

$email = trim(strip_tags(htmlspecialchars($_POST['email'])));
$password = trim(strip_tags(htmlspecialchars($_POST['password'])));

// validate form inputs
$errors = [];
$authFailureMessage = 'Authentication failed';

if (!Validator::email($email)) {
    $errors['email'] = $authFailureMessage;
}

if (!Validator::string($password, $dbConfig['password_char_min'], $dbConfig['password_char_max'])) {
    $errors['password'] = $authFailureMessage;
}

if (! empty($errors)) {
    view('sessions/create.view.php', ['errors' => $errors]);
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