<?php
namespace Ajde\Core;

use Ajde\Exception\Handler;


class Exception extends \Exception
{
    protected $_traceOnOutput = true;

    public function __construct($message = null, $code = 0, $traceOnOutput = true)
    {
        $this->_traceOnOutput = $traceOnOutput;
        \Exception::__construct($message, $code);
    }

    public function traceOnOutput()
    {
        return $this->_traceOnOutput;
    }

    public function process()
    {
        return Handler::handler($this);
    }

}