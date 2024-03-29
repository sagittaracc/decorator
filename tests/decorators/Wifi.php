<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Sagittaracc\PhpPythonDecorator\PhpDecorator;

final class Wifi extends PhpDecorator
{
    public function wrapper(mixed $price)
    {
        return 10 * $price;
    }
}