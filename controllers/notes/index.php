<?php

use KTS\src\Core\Database;

require __DIR__ . '/../../vendor/autoload.php';

$dbConfig = require __DIR__ . '/../../config/database.php';

$db = new Database($dbConfig, $dbConfig['user'], $dbConfig['pass']);

$currentUserId = (int) $dbConfig['test_user_id'];

$notes = $db->query("SELECT * FROM notes WHERE user_id = $currentUserId")->get();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);
