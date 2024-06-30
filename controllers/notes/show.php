<?php

use KTS\src\Core\Database;

$dbConfig = require __DIR__ . '/../../config/database.php';
$db = new Database($dbConfig, $dbConfig['user'], $dbConfig['pass']);

$currentUserId = (int) $dbConfig['test_user_id'];

$note = $db->query(
    'SELECT * FROM notes WHERE id = :id',
    [
        'id' => strip_tags($_GET['id'])
    ])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note,
]);
