<?php

$dbConfig = require __DIR__ . '/../config/database.php';

$db = new Database($dbConfig, 'root', '');

$heading = 'Create Note';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db->query("INSERT INTO notes (body, user_id) VALUES (:body, :user_id)",
    [
        'body' => $_POST['body'],
        'user_id' => $dbConfig['test_user_id']
    ]);
}

require __DIR__ . '/../views/note_create.view.php';
