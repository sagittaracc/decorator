<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Sagittaracc\PhpPythonDecorator\PhpDecorator;

final class ExtraRoom extends PhpDecorator
{
    public function wrapper(mixed $price)
    {
        return 2 * $price;
    }
}