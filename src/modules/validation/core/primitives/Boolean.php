<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\core\primitives;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\Validator;

#[Attribute]
class Boolean extends Validator
{
    public function validation($value)
    {
        return is_bool($value);
    }
}