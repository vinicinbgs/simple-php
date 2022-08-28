<?php

namespace Packages\Http;

use Packages\Logging\Log;
use Packages\Http\Response;
use Packages\Http\HttpExceptionInterface;

use Throwable;

class Controller
{
    public function __construct()
    {
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler(Throwable $exception)
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
