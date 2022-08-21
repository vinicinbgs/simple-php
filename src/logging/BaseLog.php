<?php

namespace App\Logging;

use Packages\Logging\Log;
use Packages\Logging\LogInterface;

use App\Logging\Processors\RequestProcessor;

class BaseLog implements LogInterface
{
    protected $logger;

    protected $fields;

    protected $message;

    protected $context;

    public function __construct($message, array $context)
    {
        $this->logger = new Log();
        $this->message = $message;
        $this->context = $context;
    }

    public function emit()
    {
        $this->logger->pushProcessor(new RequestProcessor());

        $this->logger->info(
            $this->formatMessage($this->message),
            $this->chooseFields($this->context)
        );
    }

    private function chooseFields(array $context): array
    {
        $selectedFields = [];

        if (empty($this->fields)) {
            return $context;
        }

        foreach ($this->fields as $field) {
            if (isset($context[$field])) {
                $selectedFields[$field] = $context[$field];
            }
        }

        return $selectedFields;
    }

    private function formatMessage(string $message)
    {
        $formattedMessage = explode("\\", $message);
        return array_reverse($formattedMessage)[0];
    }
}
