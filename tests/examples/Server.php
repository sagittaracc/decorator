<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Retry;

class Server
{
    use Decorator;

    #[Retry(3)]
    function _successConnect()
    {
        return true;
    }

    #[Retry(2)]
    function _failConnect()
    {
        return false;
    }
}