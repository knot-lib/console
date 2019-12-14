<?php
declare(strict_types=1);

namespace KnotLib\Console\Request;

use Nyholm\Psr7\MessageTrait;
use Nyholm\Psr7\RequestTrait;
use Psr\Http\Message\ServerRequestInterface;
use Stk2k\ArgParser\ArgParser;

class ShellRequest implements ServerRequestInterface
{
    use MessageTrait;
    use RequestTrait;

    /** @var array */
    private $data;
    /**
     * ShellRequest constructor.
     *
     * @param array $argv
     *
     * @throws
     */
    public function __construct(array $argv)
    {
        $this->data = ArgParser::parse($argv);
    }

    public function getServerParams()
    {
        return $this->data;
    }

    public function getCookieParams()
    {
        return [];
    }

    public function withCookieParams(array $cookies)
    {
        return $this;
    }

    public function getQueryParams()
    {
        return [];
    }

    public function withQueryParams(array $query)
    {
        return $this;
    }

    public function getUploadedFiles()
    {
        return [];
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        return $this;
    }

    public function getParsedBody()
    {
        return [];
    }

    public function withParsedBody($data)
    {
        return $this;
    }

    public function getAttributes()
    {
        return [];
    }

    public function getAttribute($name, $default = null)
    {
        return null;
    }

    public function withAttribute($name, $value)
    {
        return $this;
    }

    public function withoutAttribute($name)
    {
        return $this;
    }

}