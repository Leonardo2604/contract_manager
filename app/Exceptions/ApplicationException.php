<?php

namespace App\Exceptions;

use Exception;

abstract class ApplicationException extends Exception
{
    public abstract function getTitle(): string;
}
