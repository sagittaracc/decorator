<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Sagittaracc\PhpPythonDecorator\PythonDecorator;

final class ExtraRoom extends PythonDecorator
{
    public function wrapper(mixed $price)
    {
        return 2 * $price;
    }
}