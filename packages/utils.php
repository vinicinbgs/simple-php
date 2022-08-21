<?php

use Packages\Http\Router;

if (!function_exists("getTraceId")) {
    function getTraceId()
    {
        return (Router::getInstance())->traceId;
    }
}

if (!function_exists("dd")) {
    function dd($x)
    {
        echo "<pre>";
        var_dump($x);
        echo "</pre>";
        die;
    }
}
