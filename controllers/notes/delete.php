<?php

use KTS\src\Core\Database;

$dbConfig = require __DIR__ . '/../../config/database.php';

$currentUserId = (int) $dbConfig['test_user_id'];

$db = new Database($dbConfig, $dbConfig['user'], $dbConfig['pass']);

$disabled = $_ENV['APP_ENV'] === 'production';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = $db->query('select user_id from notes where id = :id', ['id' => $_POST['id']])->get();

    $ownerId = $note[0]['user_id'];

    authorize($ownerId === $currentUserId);

    $db->query('delete from notes where id = :id', [':id' => $_POST['id']]);

    header('Location: /notes');
    exit();
}
