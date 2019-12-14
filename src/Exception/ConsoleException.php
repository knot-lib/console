<?php
declare(strict_types=1);

namespace KnotLib\Console\Exception;

use Throwable;

use KnotLib\Exception\KnotPhpException;

class ConsoleException extends KnotPhpException implements ConsoleExceptionInterface
{
    /**
     * ConsoleException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $prev
     */
    public function __construct(string $message, int $code = 0, Throwable $prev = null)
    {
        parent::__construct($message, $code, $prev);
    }
}


