<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Http\Router;

include_once __DIR__ . '/../src/config/route.php';

$router = Router::getInstance();

$router->run();
