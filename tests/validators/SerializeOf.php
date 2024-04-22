<?php

namespace Sagittaracc\PhpPythonDecorator\tests\validators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\Validator;

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

        $hasErrors = false;
        $errors = [];
        foreach ($array as $key => $value) {
            try {
                $object->{"_$key"} = $value;
            }
            catch (Exception $e) {
                $hasErrors = true;
                $errors[] = $e->getMessage();
            }
        }

        if ($hasErrors) {
            $this->addError(implode("\n", $errors));
            return false;
        }

        return true;
    }
}