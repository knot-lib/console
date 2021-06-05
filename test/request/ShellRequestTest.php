<?php
declare(strict_types=1);

namespace knotlib\console\test\request;

use PHPUnit\Framework\TestCase;
use knotlib\console\request\ShellRequest;

final class ShellRequestTest extends TestCase
{
    public function testBind()
    {
        $request = new ShellRequest([
            '123', '--name', 'David', '24 years old'
        ]);

        $expected = ['123', '--name' => 'David', '24 years old'];

        $this->assertEquals($expected, $request->getServerParams());
    }
}