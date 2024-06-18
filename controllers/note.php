<?php

$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

$heading = 'Note';
$currentUserId = 2;

$note = $db->query(
    'SELECT * FROM notes WHERE id = :id',
    [
        'id' => strip_tags($_GET['id'])
    ])->findOrFail();

authorize($note['user_id'] === $currentUserId);

require 'views/note.view.php';
