<?php

namespace Sagittaracc\PhpPythonDecorator\tests\classes;

use Sagittaracc\PhpPythonDecorator\Decorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Log;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Timer;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Retry;

class Calc
{
    use Decorator;

    #[Timer]
    #[Log]
    protected function sum1($a, $b)
    {
        return $a + $b;
    }

    protected function sum2($a, $b)
    {
        return $a + $b;
    }

    #[Retry(2)]
    protected function div1($a, $b)
    {
        return $a / $b;
    }

    #[Retry(3)]
    protected function div2($a, $b)
    {
        return $a / $b;
    }
}