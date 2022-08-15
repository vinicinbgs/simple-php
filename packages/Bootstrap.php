<?php

namespace Packages;

use Packages\Http\Router;
use Packages\Logging\Log;

class Bootstrap
{
    public static function init()
    {
        self::loadEnv();

        date_default_timezone_set(getenv("APP_TIMEZONE") ?? 'America/Sao_paulo');

        $router = Router::getInstance();

        $router->run();

        register_shutdown_function(function () {
            (new Log())->info("MeasurePerformance", [
                "execution_time" => round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]), 3),
                "memory_usage" => round((memory_get_usage() / 1024) / 1024, 2)
            ]);
        });
    }

    public static function loadEnv()
    {
        $env = file_get_contents(__DIR__ . "/../.env");
        $format = explode("\n", $env);

        foreach ($format as $variable) {
            if (empty($variable)) {
                continue;
            }

            putenv($variable);

            list($variable, $value) = explode("=", $variable);
            $_ENV[$variable] = $value;
        }
    }
}
