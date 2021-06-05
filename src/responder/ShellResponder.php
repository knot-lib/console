<?php
declare(strict_types=1);

namespace knotlib\console\responder;

use Psr\Http\Message\ResponseInterface;

use knotlib\kernel\responder\ResponderInterface;

class ShellResponder implements ResponderInterface
{
    /**
     * Process response
     *
     * @param ResponseInterface $response
     */
    public function respond(ResponseInterface $response)
    {
        $body = $response->getBody();

        echo $body, PHP_EOL;
    }
}