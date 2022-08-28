<?php

namespace App\Exceptions;

use Packages\Http\HttpExceptionInterface;
use Exception;

class DatabaseException extends Exception implements HttpExceptionInterface
{
}
