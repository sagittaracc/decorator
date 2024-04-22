<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\core\primitives;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\Validator;

#[Attribute]
class Number extends Validator
{
    public function validation($value)
    {
        return is_int($value);
    }
}