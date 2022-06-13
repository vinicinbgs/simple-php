<?php

use App\Http\Router;

$route = Router::getInstance();

$route->get('/home', 'HomeController@index');
$route->post('/home', 'HomeController@store');
$route->put('/home', 'HomeController@store');
