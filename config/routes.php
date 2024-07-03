<?php

use KTS\src\Core\Router;

$router = new Router();

// Static Landing Pages
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

// User Resources
$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php');

// Note Resources
$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->get('/note', 'controllers/notes/show.php');
$router->delete('/note', 'controllers/notes/delete.php');
$router->get('/note/create', 'controllers/notes/create.php');
$router->get('/note/edit', 'controllers/notes/edit.php');
$router->patch('/note/update', 'controllers/notes/update.php');
$router->post('/note/create', 'controllers/notes/store.php');
$router->delete('/note', 'controllers/notes/delete.php');
