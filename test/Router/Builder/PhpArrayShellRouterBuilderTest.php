<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use KnotLib\Console\Router\ShellRouter;
use KnotLib\Console\Router\Builder\PhpArrayShellRouterBuilder;

final class PhpArrayShellRouterBuilderTest extends TestCase
{
    private $routing_rule = [

        'hello:world' => 'hello.world',
        'hello:maria' => 'hello.maria',
        'hello:good:morning' => [
            '*' => ShellRouter::ROUTE_NOT_FOUND,
            'human' => 'hello.good.morning',
        ],
        'goobye:doggy' => [
            '*' => ShellRouter::ROUTE_NOT_FOUND,
            'dog' => 'goobye.doggy',
        ],
    ];

    /**
     * @throws
     */
    public function testBind()
    {
        $router = new ShellRouter(function($route_url, $filter, $route_name){
            echo 'routed: ' . json_encode([$route_url, $filter, $route_name]);
        });
        (new PhpArrayShellRouterBuilder($router, $this->routing_rule))->build();

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