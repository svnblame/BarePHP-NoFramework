<?php

use Core\Router;

$router = new Router();

// Static Landing Pages
$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

// User Registration and Authentication
$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');
$router->get('/sessions', 'Sessions/create.php')->only('guest');
$router->post('/sessions', 'Sessions/store.php')->only('guest');
$router->delete('/sessions', 'Sessions/delete.php')->only('auth');

// Note Resources
$router->get('/notes', 'Notes/index.php')->only('auth');
$router->get('/note', 'Notes/show.php')->only('auth');
$router->delete('/note', 'Notes/delete.php')->only('auth');
$router->get('/note/create', 'Notes/create.php')->only('auth');
$router->get('/note/edit', 'Notes/edit.php')->only('auth');
$router->patch('/note', 'Notes/update.php')->only('auth');
$router->post('/note', 'Notes/store.php')->only('auth');
