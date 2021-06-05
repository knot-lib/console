<?php
declare(strict_types=1);

namespace knotlib\console\router\builder;

use knotlib\console\router\ShellRouterBuilderInterface;
use knotlib\kernel\router\RouterInterface;

abstract class AbstractShellRouterBuilder implements ShellRouterBuilderInterface
{
    /** @var RouterInterface */
    protected $router;

    /**
     * AbstractRouterBuilder constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
}