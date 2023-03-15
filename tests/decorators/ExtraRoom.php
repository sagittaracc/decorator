<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class ExtraRoom extends PythonDecorator
{
    public function wrapper($func)
    {
        return 2 * $func();
    }
}