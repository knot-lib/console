<?php
namespace KnotLib\Console\Request;

use InvalidArgumentException;

use KnotLib\Kernel\Request\RequestParamsType;
use KnotLib\Kernel\Request\RequestInterface;
use Stk2k\ArgParser\ArgParser;

class ShellRequest implements RequestInterface
{
    /** @var array */
    private $orderd_params;

    /** @var array */
    private $named_params;

    /**
     * ShellRequest constructor.
     *
     * @param array $argv
     *
     * @throws
     */
    public function __construct(array $argv)
    {
        $data = ArgParser::parse($argv);

        $this->orderd_params = array_filter($data, function(/** @noinspection PhpUnusedParameterInspection */ $value, $key){
            return is_int($key);
        }, ARRAY_FILTER_USE_BOTH);
        $this->named_params = array_filter($data, function(/** @noinspection PhpUnusedParameterInspection */ $value, $key){
            return is_string($key);
        }, ARRAY_FILTER_USE_BOTH);

    }

    /**
     * {@inheritDoc}
     */
    public function getParams(string $params_type) : array
    {
        switch($params_type){
            case RequestParamsType::CONSOLE_ORDERED:
                return $this->orderd_params;

            case RequestParamsType::CONSOLE_NAMED:
                return $this->named_params;
        }
        throw new InvalidArgumentException('Invalid bag type: ' . $params_type);
    }
}