<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Triple extends PythonDecorator
{
    public function wrapper($func)
    {
        return 3 * $func();
    }
}