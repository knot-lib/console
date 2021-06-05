<?php
declare(strict_types=1);

namespace knotlib\console\exception;

use knotlib\exception\KnotPhpExceptionInterface;
use knotlib\exception\runtime\RuntimeExceptionInterface;

interface ConsoleExceptionInterface extends KnotPhpExceptionInterface, RuntimeExceptionInterface
{
}

