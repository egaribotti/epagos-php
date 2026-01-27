<?php

namespace Epagos\Exceptions;

use Exception;
use Throwable;

class EpagosException extends Exception
{
    public function __construct(string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
