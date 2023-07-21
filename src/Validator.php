<?php

namespace Sagittaracc\PhpPythonDecorator;

use Exception;
use sagittaracc\PlaceholderHelper;

/**
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
abstract class Validator extends PythonDecorator
{
    public function wrapper($closure)
    {
        [$object, $property, $value] = $closure();
        
        if ($this->validation($value)) {
            return;
        }

        $class = get_class($object);
        
        throw new Exception(
            (new PlaceholderHelper("$class::$property validation error! ? is not satisfied by $this!"))->bind($value)
        );
    }
    
    abstract public function validation($value);

    public function __toString()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}