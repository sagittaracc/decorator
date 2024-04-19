<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\primitives;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validator;

#[Attribute]
class Str extends Validator
{
    public function validation($value)
    {
        return is_string($value);
    }
}