<?php

require_once __DIR__ . "/helpers/utils.php";
require_once __DIR__ . "/helpers/Database.php";
require_once __DIR__ . "/helpers/Response.php";
require __DIR__ . '/router.php';

/*$user_id = strip_tags($_GET['id']);

$query = "SELECT `title` FROM `posts` WHERE `id` = :id";

$posts = $db->query($query, [':id' => $user_id])->fetchAll();

if (!$posts) {
    http_response_code(404);
    echo "No posts found with the provided id of {$user_id}.";
} else {
    echo '<ul>';
    foreach ($posts as $post) {
        echo '<li>' . $post['title'] . '</li>';
    }
    echo '</ul>';
}*/
