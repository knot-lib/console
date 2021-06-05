<?php
/** @noinspection PhpMissingReturnTypeInspection */
declare(strict_types=1);

namespace knotlib\console\response;

use Nyholm\Psr7\MessageTrait;
use Psr\Http\Message\ResponseInterface;

class ShellResponse implements ResponseInterface
{
    use MessageTrait;

    public function getStatusCode()
    {
        return 200;
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        return $this;
    }

    public function getReasonPhrase()
    {
        return 'success';
    }


}
