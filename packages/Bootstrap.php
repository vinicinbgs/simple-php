<?php

namespace Packages;

use App\Logging\MeasurePerformance;
use Packages\Http\Router;
use Packages\Logging\Log;

include_once "utils.php";
class Bootstrap
{
    public static function init()
    {
        self::loadEnv();

        date_default_timezone_set(getenv("APP_TIMEZONE") ?? 'America/Sao_paulo');

        $router = Router::getInstance();

        $router->generateTraceId();

        $router->run();

        register_shutdown_function(function () {
            (new MeasurePerformance([
                "execution_time" => round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]), 3),
                "memory_usage" => round((memory_get_usage() / 1024 / 1024), 2)
            ]))->emit();
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
