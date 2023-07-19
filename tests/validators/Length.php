<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\Validator;

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
        return strlen($value) === $this->length;
    }
}