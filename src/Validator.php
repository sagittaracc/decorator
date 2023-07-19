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
        $value = is_array($value) ? json_encode($value) : $value;

        // TODO: $value подставлять через sagittaracc/placeholder где есть подстановки в строку в зависимости от типа
        throw new Exception("$class::$property validation error! `$value` is not satisfied by $this!");
    }
    
    abstract public function validation($value);

    public function __toString()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}