<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\Validator;

#[Attribute]
final class UInt8 extends Validator
{
    public function validation($value)
    {
        return $value >= 0 && $value <= 255;
    }
}