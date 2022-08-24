<?php

namespace Packages\Logging;

use Psr\Log\AbstractLogger;

use DateTime;
use DateTimeInterface;
use Packages\Logging\ProcessorInterface;

class Log extends AbstractLogger
{
    private $output;

    public function log($level, $message, array $context = array())
    {
        $driver = "stdout";
        $defaultOutput = ["message" => $message, "context" => $context];
        $output = isset($this->output) ? array_merge($defaultOutput, $this->output) : $defaultOutput;

        $dateTime = (new DateTime())->format(DateTimeInterface::ATOM);

        $stream = fopen("php://{$driver}", 'w');
        fputs($stream, "[$dateTime] $level: " . json_encode($output) .  "\n");
        fclose($stream);
    }

    public function pushProcessor(ProcessorInterface $processor)
    {
        $this->output = $processor();
    }
}
