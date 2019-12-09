<?php
declare(strict_types=1);

namespace KnotLib\Console\Router;

use KnotLib\Kernel\Router\RouterInterface;
use KnotLib\Console\Exception\ShellRouterBuildingException;

interface ShellRouterBuilderInterface
{
    /**
     * Build a router
     *
     * @return RouterInterface
     *
     * @throws ShellRouterBuildingException
     */
    public function build() : RouterInterface;
}