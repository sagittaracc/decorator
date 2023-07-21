<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\Validator;

#[Attribute]
final class SerializeOf extends Validator
{
    function __construct(
        public string $classObject
    )
    {}

    public function validation($array)
    {
        if (array_is_list($array)) {
            return false;
        }

        $object = new $this->classObject;

        foreach ($array as $key => $value) {
            try {
                $object->{"_$key"} = $value;
            }
            catch (Exception $e) {
                $this->addError($e->getMessage());
                return false;
            }
        }

        return true;
    }

    public function __toString()
    {
        $classObject = (new \ReflectionClass($this->classObject))->getShortName();
        return "SerializeOf($classObject)";
    }
}