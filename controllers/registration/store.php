<?php

use KTS\src\Core\App;
use KTS\src\Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// validate form inputs
$errors = [];

$dbConfig = require(base_path('/config/database.php'));

if (! Validator::email($email)) {
    $errors['email'] = 'Email address is invalid';
}

if (! Validator::string($password, $dbConfig['password_char_min'], $dbConfig['password_char_max'])) {
    $errors['password'] = "Password must be between {$dbConfig['password_char_min']} and {$dbConfig['password_char_max']} characters";
}

if (! empty($errors)) {
    view('registration/create.view.php', ['errors' => $errors]);
}

// check if account already exists
$db = App::resolve('Core\Database');

$result = $db->query('select count(`id`) as cnt from users where email = :email', ['email' => $email])->find();

if ($result['cnt']) {
    // @todo Temp... Will redirect to /login after that route is built
    $errors['email'] = 'Email address is already in use';
    view('index.view.php', [
        'heading' => 'Home',
        'errors' => $errors,
    ]);
    exit();
} else {
    // If User not exist, create new User
    $db->query('insert into users (email, password) values (:email, :password)', [
        'email' => $email,
        'password' => $password,
    ]);

    // @todo Refactor to use PDO::lastInsertId()
    $user_id = $db->query('select id from users where email = :email', ['email' => $email])->find();

    // flag that the User has logged in
    $_SESSION['user'] = [
        'logged_in' => true,
        'user_id' => $user_id['id'],
        'email' => $email,
    ];

    // redirect to Notes page
    view('notes/index.view.php', [
        'heading' => 'My Notes',
        'notes', [],
    ]);
    exit();
}

    // If no, save to database

    // login the new user

    // redirect to home page

