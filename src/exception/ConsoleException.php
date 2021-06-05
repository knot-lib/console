<?php
declare(strict_types=1);

namespace knotlib\console\exception;

use Throwable;

use knotlib\exception\KnotPhpException;

class ConsoleException extends KnotPhpException implements ConsoleExceptionInterface
{
    /**
     * ConsoleException constructor.
     *
     * @param string $message
     * @param Throwable|null $prev
     */
    public function __construct(string $message, Throwable $prev = null)
    {
        parent::__construct($message, 0, $prev);
    }
}


