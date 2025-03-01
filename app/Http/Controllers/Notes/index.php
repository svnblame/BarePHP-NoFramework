<?php

use Core\App;

//require __DIR__ . '/../../vendor/autoload.php';

try {
    $db = App::resolve('Core\Database');
} catch (Exception $e) {
    error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage());
    abort(503);
}

$dbConfig = $db::config();

$currentUserId = $_SESSION['user']['id'];

$notes = $db->query("SELECT * FROM notes WHERE user_id = $currentUserId")->get();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);
