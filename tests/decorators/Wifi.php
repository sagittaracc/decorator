<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Sagittaracc\PhpPythonDecorator\PythonDecorator;

final class Wifi extends PythonDecorator
{
    public function wrapper(mixed $price)
    {
        return 10 * $price;
    }
}