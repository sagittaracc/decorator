<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\console\core\Console;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Log;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Middleware;
use Sagittaracc\PhpPythonDecorator\tests\attributes\Route;

class Controller
{
    use Decorator;

    #[Route('/hello')]
    #[Route('/hello/(\w+)')]
    function greetingPerson($name = 'guest')
    {
        return "Hello, $name";
    }
    
    #[Route('/log')]
    #[Log]
    function log()
    {
        return 'log';
    }

    #[Route(url: '/data', method: 'POST')]
    #[Middleware]
    function data()
    {
        return 'secret data';
    }

    #[Console('hello')]
    function greetingFromConsole($name)
    {
        return "Hello, $name. This is from console";
    }
}