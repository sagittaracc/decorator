<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Double;

#[Double]
class DoubleEverything
{
    use Decorator;

    #[Double]
    function sum($a, $b)
    {
        return $a + $b;
    }
}