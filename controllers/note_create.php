<?php

$dbConfig = require __DIR__ . '/../config/database.php';

$db = new Database($dbConfig, 'root', '');

$heading = 'Create Note';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    if (isset($_POST['body']) && 0 === strlen($_POST['body'])) {
        $errors['body'] = 'A body is required';
    }

    if (isset($_POST['body']) && strlen($_POST['body']) > $dbConfig['note_body_char_limit']) {
        $errors['body'] = 'The body of your note is too long. Maximum number of characters is ' . $dbConfig['note_body_char_limit'] . '.';
    }

    if (empty($errors)) {
        $db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user_id)",
            [
                'body' => $_POST['body'],
                'user_id' => $dbConfig['test_user_id']
            ]);
    }
}

require __DIR__ . '/../views/note_create.view.php';
