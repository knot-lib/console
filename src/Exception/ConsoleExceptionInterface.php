<?php
declare(strict_types=1);

namespace KnotLib\Console\Exception;

use KnotLib\Exception\KnotPhpExceptionInterface;
use KnotLib\Exception\Runtime\RuntimeExceptionInterface;

interface ConsoleExceptionInterface extends KnotPhpExceptionInterface, RuntimeExceptionInterface
{
}

