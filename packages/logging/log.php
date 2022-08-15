<?php

namespace Packages\Logging;

use Psr\Log\AbstractLogger;

use DateTime;
use DateTimeInterface;

class Log extends AbstractLogger
{
    public function log($level, $message, array $context = array())
    {
        $driver = "stdout";

        $output = ["message" => $message, "context" => $context];

        $dateTime = (new DateTime())->format(DateTimeInterface::ATOM);

        $stream = fopen("php://{$driver}", 'w');
        fputs($stream, "[$dateTime] $level: ");
        fputs($stream, json_encode($output));
        fputs($stream, "\n");
        fclose($stream);
    }
}
