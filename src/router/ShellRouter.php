<?php
declare(strict_types=1);

namespace knotlib\console\router;

use Closure;
use knotlib\kernel\router\RouterInterface;

final class ShellRouter implements RouterInterface
{
    const ROUTE_NOT_FOUND   = 'not_found';

    /** @var callable|ShellDispatcherInterface */
    private $dispatcher;

    /** @var callable */
    private $not_found_callback;

    /** @var array */
    private $route;

    /**
     * Router constructor.
     *
     * @param callback|Closure|ShellDispatcherInterface $dispatcher
     */
    public function __construct($dispatcher = null)
    {
        $this->dispatcher = $dispatcher;
        $this->route = [];
    }

    /**
     * [@inheritDoc}
     */
    public function bind(string $routing_rule, string $filter, string $route_name, callable $callback = null): RouterInterface
    {
        $this->route[$routing_rule . '@' . $filter] = [
            'route_name' => $route_name,
            'callback' => $callback,
        ];
        return $this;
    }

    /**
     * [@inheritDoc}
     */
    public function notFound(callable $not_found_callback = null): RouterInterface
    {
        $this->not_found_callback = $not_found_callback;
        return $this;
    }

    /**
     * [@inheritDoc}
     */
    public function route(string $route_url, string $filter, callable $callback = null)
    {
        if (isset($this->route[$route_url . '@' . $filter])){
            $route = $this->route[$route_url . '@' . $filter];
            $route_name = $route['route_name'] ?? '';
            $route_callback = $route['callback'] ?? null;

            $this->doRouteCallback($route_url, $route_name, $route_callback, $callback);
        }
        else if (isset($this->route[$route_url . '@*'])){
            $route = $this->route[$route_url . '@*'];
            $route_name = $route['route_name'] ?? '';
            $route_callback = $route['callback'] ?? null;

            $this->doRouteCallback($route_url, $route_name, $route_callback, $callback);
        }
        else{
            // not found callback
            $this->doRouteCallback($route_url, self::ROUTE_NOT_FOUND, $callback);

            if (is_callable($this->not_found_callback)){
                ($this->not_found_callback)($route_url, $filter);
            }
        }
        return $this;
    }

    /**
     * @param string $route_url
     * @param string $route_name
     * @param callable[] $callbacks
     */
    private function doRouteCallback(string $route_url, string $route_name, ... $callbacks)
    {
        foreach($callbacks as $callback){
            if (is_callable($callback)){
                ($callback)($route_url, [], $route_name);
            }
        }
        if (is_callable($this->dispatcher)){
            ($this->dispatcher)($route_url, [], $route_name);
        }
        else if ($this->dispatcher instanceof ShellDispatcherInterface){
            $this->dispatcher->dispatch($route_url, [], $route_name);
        }
    }
}