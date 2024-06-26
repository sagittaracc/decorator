<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\core\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\Validator;

#[Attribute]
class ArrayOf extends Validator
{
    protected mixed $of;

    public function __construct($of)
    {
        $this->of = $of;
    }

    public function validation($value)
    {
        if (!is_array($value)) {
            return false;
        }

        $of = (new $this->of)->bindTo($this->getObject());

        foreach ($value as $item) {
            $of->wrapper($item);
        }

        return true;
    }
}