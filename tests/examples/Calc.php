<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Log;
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
}