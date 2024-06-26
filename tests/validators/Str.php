<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\Validator;

#[Attribute]
final class Str extends Validator
{
    public function validation($value)
    {
        return is_string($value);
    }
}