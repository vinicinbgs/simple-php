<?php

require __DIR__ . '/../vendor/autoload.php';

include_once __DIR__ . '/../src/config/routes.php';

use Packages\Bootstrap;

use App\Logging\MeasurePerformance;

Bootstrap::init();

Bootstrap::measurePerformance(new MeasurePerformance([
    "execution_time" => round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]), 3),
    "memory_usage" => round((memory_get_usage() / 1024 / 1024), 2)
]));
