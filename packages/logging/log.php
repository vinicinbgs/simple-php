<?php

namespace Packages\Logging;

use Psr\Log\AbstractLogger;

use DateTime;
use DateTimeInterface;
use stdClass;

class Log extends AbstractLogger
{
    private $output;

    public function log($level, $message, array $context = array())
    {
        $driver = "stdout";

        $output = array_merge(["message" => $message, "context" => $context], $this->output);

        $dateTime = (new DateTime())->format(DateTimeInterface::ATOM);

        $stream = fopen("php://{$driver}", 'w');
        fputs($stream, "[$dateTime] $level: ");
        fputs($stream, json_encode($output));
        fputs($stream, "\n");
        fclose($stream);
    }

    public function pushProcessor($processor)
    {
        $this->output = $processor();
    }
}
