<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\core\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\Validator;

#[Attribute]
class Nullable extends Validator
{
    public function __construct(
        protected mixed $type,
    ) {}

    public function validation($value)
    {
        if (is_null($value)) {
            return true;
        }

        $typeValidator = (new $this->type)->bindTo($this->getObject());
        $typeValidator->wrapper($value);

        return true;
    }
}