<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\PythonObject;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Log;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Timer;

class CalcDecoratorOff extends PythonObject
{
    // use Decorator;

    #[Timer]
    #[Log]
    function _sum1($a, $b)
    {
        return $a + $b;
    }

    function _sum2($a, $b)
    {
        return $a + $b;
    }
}