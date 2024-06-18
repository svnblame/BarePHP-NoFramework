<?php

$config = require 'config.php';

$db = new Database($config['database'], 'root', '');

$heading = 'My Notes';

$currentUserId = 2;

$notes = $db->query("SELECT * FROM notes WHERE user_id = $currentUserId")->get();

require 'views/notes.view.php';
