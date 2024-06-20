<?php

$dbConfig = require __DIR__ . '/../config/database.php';
$db = new Database($dbConfig, 'root', '');

$heading = 'Note';
$currentUserId = $dbConfig['test_user_id'];

$note = $db->query(
    'SELECT * FROM notes WHERE id = :id',
    [
        'id' => strip_tags($_GET['id'])
    ])->findOrFail();

authorize($note['user_id'] === $currentUserId);

require 'views/note.view.php';
