<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\Validator;

#[Attribute]
final class LessThan extends Validator
{
    function __construct(
        public $supreme
    )
    {}

    public function validation($value)
    {
        $supreme = $this->supreme;
        return $value <= $this->getObject()->$supreme;
    }
}