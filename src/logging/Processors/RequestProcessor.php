<?php

namespace App\Logging\Processors;

class RequestProcessor
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
