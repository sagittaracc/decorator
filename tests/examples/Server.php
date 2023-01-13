<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Retry;

class Server
{
    use Decorator;

    #[Retry(3)]
    function successConnect()
    {
        return true;
    }

    #[Retry(2)]
    function failConnect()
    {
        return false;
    }
}