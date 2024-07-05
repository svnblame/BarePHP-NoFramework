<?php

use KTS\src\Core\App;

if ('production' == $_ENV['APP_ENV']) view('index.view.php', [
    'heading' => 'Home',
]);

try {
    $db = App::resolve('Core\Database');
} catch (Exception $e) {
    error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage());
    abort(503);
}

$dbConfig = $db::config();

$currentUserId = $_SESSION['user']['id'];

$note = $db->query(
    'SELECT * FROM notes WHERE id = :id',
    [
        'id' => strip_tags($_GET['id'])
    ])->findOrFail();

authorize($note['user_id'] === $currentUserId);

 view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'note' => $note,
     'errors' => [],
]);
