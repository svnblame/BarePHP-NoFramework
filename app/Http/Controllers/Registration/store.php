<?php

use Core\App;
use Core\Authenticator;
use Core\Validator;

$email = trim(strip_tags(htmlspecialchars($_POST['email'])));
$password = trim(strip_tags(htmlspecialchars($_POST['password'])));
$firstName = trim(strip_tags(htmlspecialchars($_POST['first-name'])));
$lastName = trim(strip_tags(htmlspecialchars($_POST['last-name'])));

$dbConfig = require(base_path('/config/database.php'));

// validate form inputs
$errors = [];

if (! Validator::email($email)) {
    $errors['email'] = 'Email address is invalid';
}

if (! Validator::string($password, $dbConfig['password_char_min'], $dbConfig['password_char_max'])) {
    $errors['password'] = "Password must be between {$dbConfig['password_char_min']} and {$dbConfig['password_char_max']} characters";
}

if (! Validator::string($firstName, $dbConfig['name_char_min'], $dbConfig['name_char_max'])) {
    $errors['first-name'] = "First name must be between {$dbConfig['name_char_min']} and {$dbConfig['name_char_max']} characters";
}

if (! Validator::string($lastName, $dbConfig['name_char_min'], $dbConfig['name_char_max'])) {
    $errors['last-name'] = "Last name must be between {$dbConfig['name_char_min']} and {$dbConfig['name_char_max']} characters";
}

if (! empty($errors)) {
    view('registration/create.view.php', ['errors' => $errors]);
}

try {
    $db = App::resolve('Core\Database');
} catch (Exception $e) {
    error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage());
    abort(503);
}

$result = $db->query('select count(`id`) as cnt from users where email = :email', ['email' => $email])->find();

if ($result['cnt'] > 0) {
    $errors['email'] = 'Email address is already in use';
    view('registration/create.view.php', ['errors' => $errors]);
} else {
    // If User not exist, create new User
    $db->query('insert into users (email, password, first_name, last_name, last_login_from) values (:email, :password, :first_name, :last_name, :last_login_from)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'first_name' => $firstName,
        'last_name' => $lastName,
        'last_login_from' => $_SERVER['REMOTE_ADDR'],
    ]);

    $auth = new Authenticator();

    // Log in the User
    try {
        (new Authenticator)->attempt($email, $password);
    } catch (Exception $e) {
        error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage());
        abort(503);
    }

    // redirect to Home page
    redirect('/');
}
