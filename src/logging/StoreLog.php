<?php

namespace App\Logging;

class StoreLog extends BaseLog
{
    public function __construct(array $context)
    {
        $this->fields = [];

        parent::__construct(self::class, $context);
    }
}
