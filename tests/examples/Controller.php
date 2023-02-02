<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Route;

class Controller
{
    use Decorator;

    #[Route('/hello')]
    function greetings()
    {
        return "Hello world!";
    }

    #[Route('/hello/(\w+)')]
    function greetingPerson($name)
    {
        return "Hello, $name";
    }
}