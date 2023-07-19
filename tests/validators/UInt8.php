<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

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