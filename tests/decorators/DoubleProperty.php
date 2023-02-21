<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class DoubleProperty extends PythonDecorator
{
    public function wrapper($property)
    {
        return 2 * $property;
    }
}