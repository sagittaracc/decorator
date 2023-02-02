<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Router;

class Controller
{
    use Decorator;

    #[Router('/hello')]
    function greetings()
    {
        return "Hello world!";
    }

    #[Router('/hello/(\w+)')]
    function greetingPerson($name)
    {
        return "Hello, $name";
    }
}