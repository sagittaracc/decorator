<?php

namespace Sagittaracc\PhpPythonDecorator;

use Exception;

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
        $type = (new \ReflectionClass($this))->getShortName();

        throw new Exception("$class::$property validation error! $value is not $type!");
    }
    
    abstract public function validation($value);
}