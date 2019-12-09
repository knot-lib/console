<?php
namespace KnotLib\Console\Response;

use KnotLib\Kernel\Response\ResponseInterface;
use KnotLib\Kernel\Response\StreamInterface;

class ShellResponse implements ResponseInterface
{
    /** @var StreamInterface */
    private $stream;

    /**
     * Get/set body stream
     *
     * @param StreamInterface $stream
     *
     * @return StreamInterface
     */
    public function body(StreamInterface $stream = null) : StreamInterface
    {
        return $this->stream;
    }
}
