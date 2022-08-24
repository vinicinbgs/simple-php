<?php

namespace Packages;

use Packages\Http\Router;

include_once "utils.php";
class Bootstrap
{
    public static function init()
    {
        self::loadEnv();

        self::setTimezone();

        $router = Router::getInstance();

        $router->generateTraceId();

        $router->run();
    }

    private static function loadEnv()
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

    private static function setTimezone()
    {
        $timezone = getenv("APP_TIMEZONE") ?? 'Etc/UTC';
        date_default_timezone_set($timezone);
    }
}
