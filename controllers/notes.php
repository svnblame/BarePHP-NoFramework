<?php

$dbConfig = require __DIR__ . '/../config/database.php';

$db = new Database($dbConfig, 'root', '');

$heading = 'My Notes';

$currentUserId = $dbConfig['test_user_id'];

$notes = $db->query("SELECT * FROM notes WHERE user_id = $currentUserId")->get();

require 'views/notes.view.php';
