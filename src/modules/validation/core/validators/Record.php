<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\core\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\Validator;

#[Attribute]
class Record extends Validator
{
    public function __construct(
        protected mixed $key,
        protected mixed $value
    ) {}

    public function validation($records)
    {
        if (!is_array($records)) {
            return false;
        }

        $keyValidator = (new $this->key)->bindTo($this->getObject());
        $valueValidator = (new $this->value)->bindTo($this->getObject());

        foreach ($records as $key => $value) {
            $keyValidator->wrapper($key);
            $valueValidator->wrapper($value);
        }

        return true;
    }
}