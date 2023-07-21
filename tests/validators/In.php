<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\Validator;

#[Attribute]
final class In extends Validator
{
    public array $in;

    function __construct(...$in)
    {
        $this->in = $in;
    }

    public function validation($value)
    {
        return in_array($value, $this->in);
    }
}