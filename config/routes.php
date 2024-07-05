<?php

use KTS\src\Core\Router;

$router = new Router();

// Static Landing Pages
$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

// User Registration and Authentication
$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');
$router->get('/sessions', 'sessions/create.php')->only('guest');
$router->post('/sessions', 'sessions/store.php')->only('guest');
$router->delete('/sessions', 'sessions/delete.php')->only('auth');

// Note Resources
$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php')->only('auth');
$router->delete('/note', 'notes/delete.php')->only('auth');
$router->get('/note/create', 'notes/create.php')->only('auth');
$router->get('/note/edit', 'notes/edit.php')->only('auth');
$router->patch('/note/update', 'notes/update.php')->only('auth');
$router->post('/note/create', 'notes/store.php')->only('auth');
