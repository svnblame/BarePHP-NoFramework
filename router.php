<?php declare(strict_types = 1);

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
'/' => 'controllers/index.php',
'/about' => 'controllers/about.php',
'/notes' => 'controllers/notes.php',
'/note' => 'controllers/note.php',
'/contact' => 'controllers/contact.php',
];

route($uri, $routes);