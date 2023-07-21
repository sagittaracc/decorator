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
        if ($value <= $this->getObject()->$supreme) {
            return true;
        }

        $this->addError($this->getTmp() . " validation error! `$value` is not less than " . $this->getObject()->$supreme);
        return false;
    }
}