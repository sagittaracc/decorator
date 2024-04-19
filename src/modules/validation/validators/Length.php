<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validator2;

#[Attribute]
final class Length extends Validator2
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