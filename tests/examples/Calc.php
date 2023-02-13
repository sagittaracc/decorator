<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Log;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Singleton;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Timer;

class Calc
{
    use Decorator;

    #[Log]
    #[Timer]
    function sum1($a, $b)
    {
        return $a + $b;
    }

    function sum2($a, $b)
    {
        return $a + $b;
    }

    #[Timer]
    private function sum3($a, $b)
    {
        return $a + $b;
    }

    #[Singleton(2)]
    function sum4($a, $b)
    {
        return $a + $b;
    }

    #[Singleton(3)]
    function sum5($a, $b)
    {
        return $a + $b;
    }

    #[Singleton(3, false)]
    function sum6($a, $b)
    {
        return $a + $b;
    }
}