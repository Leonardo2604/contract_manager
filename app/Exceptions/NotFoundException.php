<?php

namespace App\Exceptions;

use Throwable;

class NotFoundException extends ApplicationException
{
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }

    public function getTitle(): string
    {
        return "Not Found";
    }
}
