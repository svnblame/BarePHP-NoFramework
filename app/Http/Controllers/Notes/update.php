<?php

use Core\App;
use Core\Validator;

try {
    $db = App::resolve('Core\Database');
} catch (Exception $e) {
    error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage());
    abort(503);
}

$dbConfig = $db::config();
$bodyCharMin = $dbConfig['note_body_char_min'];
$bodyCharMax = $dbConfig['note_body_char_max'];
$currentUserId = $_SESSION['user']['id'];

$note = $db->query(
    'SELECT * FROM notes WHERE id = :id',
    [
        'id' => strip_tags($_POST['id'])
    ])->findOrFail();

// authorize the current user can edit the note
authorize($note['user_id'] === $currentUserId);

// validate the form data
$errors = [];

if (! Validator::string($_POST['body'], $bodyCharMin, $bodyCharMax)) {
    $errors['body'] = "The body must contain between {$bodyCharMin} and {$bodyCharMax} characters";
}

// if no validation errors, update the record in the notes database table
if (count($errors)) {
    view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note,
    ]);

    exit();
}

$db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'id' => strip_tags($_POST['id']),
    'body' => strip_tags($_POST['body']),
]);

$notes = $db->query("SELECT * FROM notes WHERE user_id = $currentUserId")->get();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);
