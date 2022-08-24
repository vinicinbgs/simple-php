<?php

namespace App\Exceptions;

use App\Exceptions\HttpExceptionInterface;
use Exception;

class FirstException extends Exception implements HttpExceptionInterface
{
}
