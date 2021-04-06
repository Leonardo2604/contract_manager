<?php

namespace App\Exceptions;

use Throwable;

class DatabaseException extends ApplicationException
{
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, 500, $previous);
    }

    public function getTitle(): string
    {
        return "Internal Server Error";
    }
}
