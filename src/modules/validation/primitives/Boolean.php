<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\primitives;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validator;

#[Attribute]
class Boolean extends Validator
{
    public function validation($value)
    {
        return is_bool($value);
    }
}