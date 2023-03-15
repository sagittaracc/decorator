<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Wifi extends PythonDecorator
{
    public function wrapper($func)
    {
        return 10 * $func();
    }
}