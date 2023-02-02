<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Router;

class Controller
{
    use Decorator;

    #[Router]
    function action()
    {
        return "Hello world!";
    }
}