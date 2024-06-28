<?php

use Core\Database;
use Core\Validator;

$dbConfig = require __DIR__ . '/../../config/database.php';

$currentUserId = $dbConfig['test_user_id'];

$db = new Database($dbConfig, $dbConfig['user'], $dbConfig['pass']);

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (! Validator::string($_POST['body'], $dbConfig['note_body_char_min'], $dbConfig['note_body_char_max'])) {
        $errors['body'] = "The body must contain between {$dbConfig['note_body_char_min']} and {$dbConfig['note_body_char_max']} characters";
    }

    if (empty($errors)) {
        $db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user_id)",
            [
                'body' => $_POST['body'],
                'user_id' => $dbConfig['test_user_id']
            ]);

        unset($_POST['body']);

        $notes = $db->query("SELECT * FROM notes WHERE user_id = $currentUserId")->get();

        view('notes/index.view.php', [
            'heading' => 'My Notes',
            'notes' => $notes,
        ]);
    }
}

view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors' => $errors,
]);
