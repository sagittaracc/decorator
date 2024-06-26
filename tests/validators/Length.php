<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\Validator;

#[Attribute]
final class Length extends Validator
{
    private int $length;

    function __construct($length)
    {
        $this->length = $length;
    }

    public function validation($value)
    {
        if (strlen($value) <= $this->length) {
            return true;
        }

        $this->addError("`$value` is not length of $this->length");
        return false;
    }
}