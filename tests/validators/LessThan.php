<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validator;

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

        $this->addError("`$value` is not less than {$this->getObject()->$supreme}");
        return false;
    }
}