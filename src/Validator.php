<?php

namespace Sagittaracc\PhpPythonDecorator;

use Exception;
use sagittaracc\PlaceholderHelper;

/**
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
abstract class Validator extends PythonDecorator
{
    public $errorValue;

    public function wrapper($closure)
    {
        [$object, $property, $value] = $closure();

        $this->errorValue = $value;
        
        if ($this->validation($value)) {
            return;
        }

        $class = get_class($object);
        
        throw new Exception(
            (new PlaceholderHelper("$class::$property validation error! ? is not satisfied by $this!"))->bind($this->errorValue)
        );
    }
    
    abstract public function validation($value);

    public function __toString()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}