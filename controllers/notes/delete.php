<?php

use KTS\src\Core\App;

try {
    $db = App::resolve('Core\Database');
} catch (Exception $e) {
    error_log(__FILE__ . ':' . __LINE__ . ' **Exception: ' . $e->getMessage());
    abort(503);
}

$dbConfig = $db::config();

$currentUserId = $_SESSION['user']['id'];

$note = $db->query('select user_id from notes where id = :id', ['id' => $_POST['id']])->get();

$ownerId = $note[0]['user_id'];

authorize($ownerId === $currentUserId);

$db->query('delete from notes where id = :id', [':id' => $_POST['id']]);

header('Location: /notes');
exit();
