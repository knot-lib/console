<?php
declare(strict_types=1);

namespace knotlib\console\router;

use knotlib\kernel\router\RouterInterface;
use knotlib\console\exception\ShellRouterBuildingException;

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