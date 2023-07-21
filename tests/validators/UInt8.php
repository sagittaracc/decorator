<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\Validator;

#[Attribute]
final class UInt8 extends Validator
{
    public function validation($value)
    {
        if ($value >= 0 && $value <= 255) {
            return true;
        }

        $this->addDetail($this->getTmp() . " validation error! `$value` is not between 0 and 255");
        return false;
    }
}