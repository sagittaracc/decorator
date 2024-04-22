<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\core;

use Exception;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validation;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

/**
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
abstract class Validator2 extends PythonDecorator
{
    /**
     * @var bool в режиме дебаг выбрасывается исключение !С ПЕРВОЙ ОШИБКОЙ!
     */
    public bool $debug = true;

    public function wrapper($value)
    {
        if ($this->validation($value)) {
            return;
        }

        if ($this->debug) {
            throw new Exception($this->getFirstErrorLog());
        }
    }

    public function addError($error)
    {
        $validation = Validation::getInstanceFrom($this->getObject());
        $property = $this->getPropertyOrMethod();

        $validation->addError($property, $error);
    }

    public function getFirstErrorLog()
    {
        $object = $this->getObject();
        $error = Validation::getInstanceFrom($object)->getFirstError();

        $objectClass = $object::class;
        $prop = $error[0];
        $message = $error[1];

        return "$objectClass::$prop $message";
    }
    
    abstract public function validation($value);
}