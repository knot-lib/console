<?php
declare(strict_types=1);

namespace KnotLib\Console\Responder;

use Psr\Http\Message\ResponseInterface;

use KnotLib\Kernel\Responder\ResponderInterface;

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