<?php

use KTS\src\Core\Router;

$router = new Router();

// Static Landing Pages
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

// Note Resources
$router->get('/notes', 'controllers/notes/index.php');
$router->get('/note', 'controllers/notes/show.php');
$router->delete('/note', 'controllers/notes/delete.php');
$router->get('/note/create', 'controllers/notes/create.php');
$router->post('/note/create', 'controllers/notes/store.php');
$router->delete('/note', 'controllers/notes/delete.php');
