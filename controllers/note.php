<?php

$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

$heading = 'Note';
$currentUserId = 2;

$note = $db->query(
    'SELECT * FROM notes WHERE id = :id',
    [
        'id' => strip_tags($_GET['id'])
    ])->fetch();

if (! $note) abort(); // 404 Not Found

if ($note['user_id'] !== $currentUserId) abort(Response::FORBIDDEN);

require 'views/note.view.php';
