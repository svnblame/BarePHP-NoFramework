<?php

use KTS\src\Core\App;
use KTS\src\Core\Validator;

try {
    $db = App::resolve('Core\Database');
} catch (Exception $e) {
    error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage());
    abort(503);
}

$dbConfig = $db::config();

$currentUserId = $_SESSION['user']['id'];
$bodyCharMin = $dbConfig['note_body_char_min'];
$bodyCharMax = $dbConfig['note_body_char_max'];

$errors = [];

if (! ($_ENV['APP_ENV'] === 'production')) {

    if (! Validator::string($_POST['body'], $bodyCharMin, $bodyCharMax)) {
        $errors['body'] = "The body must contain between {$bodyCharMin} and {$bodyCharMax} characters";

        view('notes/create.view.php', [
            'heading' => 'Create Note',
            'errors' => $errors,
        ]);

        exit();
    }

    $db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user_id)",
        [
            'body' => $_POST['body'],
            'user_id' => $currentUserId,
        ]);

    unset($_POST['body']);

    $notes = $db->query("SELECT * FROM notes WHERE user_id = $currentUserId")->get();

    view('notes/index.view.php', [
        'heading' => 'My Notes',
        'notes' => $notes,
    ]);
}
