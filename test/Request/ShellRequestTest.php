<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use KnotLib\Console\Request\ShellRequest;
use KnotLib\Kernel\Request\RequestParamsType;

final class ShellRequestTest extends TestCase
{
    public function testBind()
    {
        $request = new ShellRequest([
            '123', '--name', 'David', '24 years old'
        ]);

        $expected = [123, '24 years old'];

        $this->assertEquals($expected, $request->getParams(RequestParamsType::CONSOLE_ORDERED));
        $this->assertEquals(['--name' => 'David'], $request->getParams(RequestParamsType::CONSOLE_NAMED));
    }
}