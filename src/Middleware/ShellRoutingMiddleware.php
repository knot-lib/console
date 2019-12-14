<?php
declare(strict_types=1);

namespace KnotLib\Console\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\EventStream\Channels;
use KnotLib\Kernel\EventStream\Events;

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
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $params = $request->getServerParams();
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