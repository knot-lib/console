<?php
declare(strict_types=1);

namespace knotlib\console\exception;

use Throwable;

class ShellRouterBuildingException extends ConsoleException
{
    /**
     * ShellRouterBuildingException constructor.
     *
     * @param string $message
     * @param Throwable|null $prev
     */
    public function __construct(string $message, Throwable $prev = null)
    {
        parent::__construct('Router building failed: ' . $message, $prev);
    }
}


