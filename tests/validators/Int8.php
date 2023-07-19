<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Int8 extends PythonDecorator
{
    public function wrapper($closure)
    {
        [$object, $property, $value] = $closure();
        $class = get_class($object);
        
        if ($value >= -128 && $value <= 127) {
            return;
        }

        throw new Exception("$class::$property validation error! $value is not Int8!");
    }
}