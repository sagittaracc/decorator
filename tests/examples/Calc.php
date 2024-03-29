<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Double;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Init;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Log;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Singleton;
use Sagittaracc\PhpPythonDecorator\tests\decorators\TimerMock;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Triple;

#[Init]
class Calc
{
    use Decorator;

    public int $prop = 0;

    #[Triple]
    #[Double]
    public int $sum = 3;

    #[Log]
    #[TimerMock]
    function sum1($a, $b)
    {
        return $a + $b;
    }

    function sum2($a, $b)
    {
        return $a + $b;
    }

    #[TimerMock]
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