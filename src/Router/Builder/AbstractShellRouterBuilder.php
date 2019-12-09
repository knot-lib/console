<?php
namespace KnotLib\Console\Router\Builder;

use KnotLib\Console\Router\ShellRouterBuilderInterface;
use KnotLib\Kernel\Router\RouterInterface;

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