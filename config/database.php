<?php

return [
    'host'   => $_ENV['DB_HOST'],
    'port'   => $_ENV['DB_PORT'],
    'user'   => $_ENV['DB_USER'],
    'pass'   => $_ENV['DB_PASSWORD'],
    'dbname' => $_ENV['DB_NAME'],
    'charset' => $_ENV["DB_CHARSET"],
    'note_body_char_max' => $_ENV['DB_NOTE_BODY_CHAR_MAX'],
    'note_body_char_min' => $_ENV['DB_NOTE_BODY_CHAR_MIN'],
    'password_char_max' => $_ENV['DB_PASSWORD_CHAR_MAX'],
    'password_char_min' => $_ENV['DB_PASSWORD_CHAR_MIN'],
    'name_char_max' => $_ENV['DB_NAME_CHAR_MAX'],
    'name_char_min' => $_ENV['DB_NAME_CHAR_MIN'],
];
