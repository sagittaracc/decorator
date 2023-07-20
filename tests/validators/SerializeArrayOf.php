<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\Validator;

#[Attribute]
final class SerializeArrayOf extends Validator
{
    private Closure $itemValidation;

    function __construct(
        public $classObject
    )
    {}

    public function validation($array)
    {
        if (!is_array($array)) {
            return false;
        }

        $object = new SerializeOf($this->classObject);

        foreach ($array as $item) {
            if ($object->validation($item)) continue;

            return false;
        }

        return true;
    }
}