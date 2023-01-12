<?php

namespace Sagittaracc\PhpPythonDecorator\tests\classes;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Retry;

class Server
{
    use Decorator;

    #[Retry(3)]
    protected function successConnect()
    {
        return true;
    }

    #[Retry(2)]
    protected function failConnect()
    {
        return false;
    }
}