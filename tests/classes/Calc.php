<?php

namespace Sagittaracc\PhpPythonDecorator\tests\classes;

use Sagittaracc\PhpPythonDecorator\Decorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\attributes\Log;
use Sagittaracc\PhpPythonDecorator\tests\attributes\Timer;

class Calc
{
    use Decorator;

    #[Timer]
    #[Log]
    protected function sum1($a, $b)
    {
        sleep(1);
        return $a + $b;
    }

    protected function sum2($a, $b)
    {
        return $a + $b;
    }
}