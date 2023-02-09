<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Double extends PythonDecorator
{
    public function wrapper($func, $args)
    {
        return 2 * $func(...$args);
    }
}