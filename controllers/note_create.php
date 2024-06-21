<?php

$dbConfig = require __DIR__ . '/../config/database.php';

$db = new Database($dbConfig, 'root', '');

require __DIR__ . '/../helpers/Validator.php';

$heading = 'Create Note';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    if (! Validator::string($_POST['body'], $dbConfig['note_body_char_min'], $dbConfig['note_body_char_max'])) {
        $errors['body'] = "The body must contain between {$dbConfig['note_body_char_min']} and {$dbConfig['note_body_char_max']} characters";
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
