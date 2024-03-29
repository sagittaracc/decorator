<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Init extends PythonDecorator
{
    public function wrapper(mixed $object, array $args)
    {
        $object->prop = 1;
    }
}