<?php

return [
    'host'   => $_ENV['DB_HOST'],
    'port'   => $_ENV['DB_PORT'],
    'user'   => $_ENV['DB_USER'],
    'pass'   => $_ENV['DB_PASSWORD'],
    'dbname' => $_ENV['DB_NAME'],
    'charset' => $_ENV["DB_CHARSET"],
    'test_user_id' => $_ENV['DB_TEST_USER_ID'],
    'note_body_char_max' => $_ENV['DB_NOTE_BODY_CHAR_MAX'],
    'note_body_char_min' => $_ENV['DB_NOTE_BODY_CHAR_MIN'],
];
