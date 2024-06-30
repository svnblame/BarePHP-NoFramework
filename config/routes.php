<?php

use KTS\src\Core\Router;

// @todo DEPRECATING...
/*return [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/notes' => 'controllers/notes/index.php',
    '/note' => 'controllers/notes/show.php',
    '/note/create' => 'controllers/notes/create.php',
    '/contact' => 'controllers/contact.php',
];*/

$router = new Router();

$router->get('/', 'controllers/index.php');
$router->delete('/note', 'controllers/notes/delete.php');
