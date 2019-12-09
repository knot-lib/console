<?php
namespace KnotLib\Console\Middleware;

use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\EventStream\Channels;
use KnotLib\Kernel\EventStream\Events;
use KnotLib\Kernel\Pipeline\MiddlewareInterface;
use KnotLib\Kernel\Request\RequestInterface;
use KnotLib\Kernel\Request\RequestHandlerInterface;
use KnotLib\Kernel\Request\RequestParamsType;
use KnotLib\Kernel\Response\ResponseInterface;

class ShellRoutingMiddleware implements MiddlewareInterface
{
    const SHELL_MIDDLEWARE_FILTER = '_';

    /** @var ApplicationInterface */
    private $app;

    /**
     * WebRouterMiddleware constructor.
     *
     * @param ApplicationInterface $app
     */
    public function __construct(ApplicationInterface $app)
    {
        $this->app = $app;
    }

    /**
     * Process middleware
     *
     * @param RequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler)
    {
        $params = $request->getParams(RequestParamsType::CONSOLE_ORDERED);
        $url = $params[1] ?? '';

        $this->app->router()->route($url, self::SHELL_MIDDLEWARE_FILTER, function(string $path, array $vars, string $route_name){

            // fire event
            $this->app->eventstream()->channel(Channels::SYSTEM)->push(Events::ROUTER_ROUTED, [
                'path' => $path,
                'vars' => $vars,
                'route_name' => $route_name,
            ])->flush();

        });

        return $handler->handle($request);
    }
}