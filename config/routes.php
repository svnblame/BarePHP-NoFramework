<?php

use KTS\src\Core\Router;

$router = new Router();

// Static Landing Pages
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

// User Registration and Authentication
$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php')->only('guest');
$router->get('/sessions', 'controllers/sessions/create.php')->only('guest');
$router->post('/sessions', 'controllers/sessions/store.php')->only('guest');
$router->delete('/sessions', 'controllers/sessions/delete.php')->only('auth');

// Note Resources
$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->get('/note', 'controllers/notes/show.php')->only('auth');
$router->delete('/note', 'controllers/notes/delete.php')->only('auth');
$router->get('/note/create', 'controllers/notes/create.php')->only('auth');
$router->get('/note/edit', 'controllers/notes/edit.php')->only('auth');
$router->patch('/note/update', 'controllers/notes/update.php')->only('auth');
$router->post('/note/create', 'controllers/notes/store.php')->only('auth');
$router->delete('/note', 'controllers/notes/delete.php')->only('auth');
