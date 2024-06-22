<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/utils.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

require base_path('Core/router.php');

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
