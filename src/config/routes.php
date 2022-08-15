<?php

use Packages\Http\Router;

use App\Controllers\HomeController;

$route = Router::getInstance();

$route->get('/home', HomeController::class . '@index');
$route->post('/home', HomeController::class . '@store');
$route->put('/home', HomeController::class . '@store');
