<?php

if ('production' !== $_ENV['APP_ENV']) view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors' => [],
]);

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'errors' => [],
]);
