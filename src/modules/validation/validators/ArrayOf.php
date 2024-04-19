<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\validators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\generics\core\Generic;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validator;

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

        // ...
        $of = new $this->of;

        if ($of instanceof Generic)
        {
            $of->bindTo($this->getObject());

            foreach ($value as $item) {
                $of->wrapper($item);
            }
        }
        else {
            // TODO: $of instanceof PrimitiveInterface (e.g. Number, String, Boolean)
        }

        return true;
    }
}