<?php

use KTS\src\Core\App;

try {
    $db = App::resolve('Core\Database');
} catch (Exception $e) {
    error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage());
    abort(503);
}

$dbConfig = $db::config();

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
