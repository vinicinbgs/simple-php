<?php

namespace App\Controllers;

use App\Exceptions\HttpExceptionInterface;
use App\Logging\MeasurePerformance;
use Packages\Http\Response;
use Packages\Logging\Log;

class BaseController
{
    public function __construct()
    {
        set_exception_handler([$this, 'exceptionHandler']);
        register_shutdown_function([$this, 'measurePerformance']);
    }

    public function measurePerformance()
    {
        $log = new MeasurePerformance([
            "execution_time" => round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]), 3),
            "memory_usage" => round((memory_get_usage() / 1024 / 1024), 2)
        ]);
        return $log->emit();
    }

    public function exceptionHandler(\Throwable $exception)
    {
        if ($exception instanceof HttpExceptionInterface) {
            $body = [
                'type' => 'error',
                'status' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'stackTrace' => array_slice(explode("\n", $exception->getTraceAsString()), 0, 5)
            ];

            (new Log())->warning($exception->getMessage(), $body);

            unset($body['stackTrace']);

            return Response::send($body, $exception->getCode());
        }

        echo "Uncaught exception: ", $exception->getMessage(), "\n";
    }
}
