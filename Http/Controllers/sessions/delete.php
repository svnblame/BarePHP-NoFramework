<?php

use KTS\src\Core\Authenticator;

$auth = new Authenticator();
$auth->logout();

redirect('/sessions');
