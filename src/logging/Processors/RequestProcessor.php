<?php

namespace App\Logging\Processors;

use Packages\Logging\ProcessorInterface;

class RequestProcessor implements ProcessorInterface
{
    public function __invoke()
    {
        return [
            'request' => [
                'trace_id' => getTraceId()
            ]
        ];
    }
}
