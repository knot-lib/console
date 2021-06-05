<?php
declare(strict_types=1);

namespace knotlib\console\test\router;

use PHPUnit\Framework\TestCase;
use knotlib\console\router\ShellRouter;

final class ShellRouterTest extends TestCase
{
    /**
     * @throws
     */
    public function testBind()
    {
        $router = new ShellRouter(function($route_url, $filter, $route_name){
            echo 'routed: ' . json_encode([$route_url, $filter, $route_name]);
        });
        $router->notFound(function($route_url, $filter){
            echo ' /not_found: ' . json_encode([$route_url, $filter]);
        });

        $router->bind('hello:world', '*', 'hello.world');

        ob_start();
        $router->route('hello:world', '*');
        $contents = ob_get_clean();

        $this->assertEquals('routed: ["hello:world",[],"hello.world"]', $contents);

        ob_start();
        $router->route('hello:good:morning', '*');
        $contents = ob_get_clean();

        $this->assertEquals('routed: ["hello:good:morning",[],"not_found"] /not_found: ["hello:good:morning","*"]', $contents);
    }
    /**
     * @throws
     */
    public function testNotFound()
    {
        $router = new ShellRouter(function($route_url, $filter, $route_name){
            echo 'routed: ' . json_encode([$route_url, $filter, $route_name]);
        });

        $router->bind('hello:world', '*', 'hello.world');

        ob_start();
        $router->route('hello:good:morning', '*');
        $contents = ob_get_clean();

        $this->assertEquals('routed: ["hello:good:morning",[],"not_found"]', $contents);

        $router->notFound(function($route_url, $filter){
            echo ' /not_found: ' . json_encode([$route_url, $filter]);
        });

        ob_start();
        $router->route('hello:good:morning', '*');
        $contents = ob_get_clean();

        $this->assertEquals('routed: ["hello:good:morning",[],"not_found"] /not_found: ["hello:good:morning","*"]', $contents);
    }
    /**
     * @throws
     */
    public function testRoute()
    {
        $router = new ShellRouter(function($route_url, $filter, $route_name){
            echo 'routed: ' . json_encode([$route_url, $filter, $route_name]);
        });

        $router->bind('hello:world', '*', 'hello.world');
        $router->bind('hello:maria', '*', 'hello.maria');
        $router->bind('hello:good:morning', 'human', 'hello.good.morning');
        $router->bind('goobye:doggy', 'dog', 'goobye.doggy');

        ob_start();
        $router->route('hello:world', '*');
        $contents = ob_get_clean();

        $this->assertEquals('routed: ["hello:world",[],"hello.world"]', $contents);

        ob_start();
        $router->route('hello:good:morning', '*');
        $contents = ob_get_clean();

        $this->assertEquals('routed: ["hello:good:morning",[],"not_found"]', $contents);

        ob_start();
        $router->route('hello:good:morning', 'human');
        $contents = ob_get_clean();

        $this->assertEquals('routed: ["hello:good:morning",[],"hello.good.morning"]', $contents);

        ob_start();
        $router->route('goobye:doggy', 'dog');
        $contents = ob_get_clean();

        $this->assertEquals('routed: ["goobye:doggy",[],"goobye.doggy"]', $contents);

        ob_start();
        $router->route('good:afternoon', '*');
        $contents = ob_get_clean();

        $this->assertEquals('routed: ["good:afternoon",[],"not_found"]', $contents);

    }
}