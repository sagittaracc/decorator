<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Closure;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\Validator;

#[Attribute]
final class ArrayOf extends Validator
{
    private Closure $itemValidation;

    function __construct(
        public $classObject
    )
    {
        $object = new $classObject;

        if ($object instanceof Validator) {
            $this->itemValidation = fn($value) => $object->validation($value);
        }
        else {
            $this->itemValidation = fn($value) => $value instanceof $object;
        }

    }

    public function validation($array)
    {
        if (!is_array($array)) {
            return false;
        }

        $itemValidation = $this->itemValidation;

        foreach ($array as $value) {
            if (!$itemValidation($value)) {
                $this->addError("Something wrong with `$value`");
                return false;
            }
        }

        return true;
    }
}