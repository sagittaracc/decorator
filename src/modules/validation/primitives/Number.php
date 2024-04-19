<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\primitives;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validator;

#[Attribute]
class Number extends Validator
{
    public function validation($value)
    {
        return is_int($value);
    }
}