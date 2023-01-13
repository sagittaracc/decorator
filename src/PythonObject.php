<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionMethod;

class PythonObject
{
    public function applyDecorator()
    {
        return false;
    }

    public function __call($func, $args)
    {
        $func = "_$func";
        $method = new ReflectionMethod($this, $func);
        $attributes = $method->getAttributes();

        if ($this->applyDecorator() && count($attributes) > 0)
        {
            $f = fn() => $this->$func(...$args);

            foreach ($attributes as $attribute) {
                $instance = $attribute->newInstance();
                $instance->className = get_class($this);
                $instance->methodName = $func;
                $f = fn() => $instance->main($f, $args);
            }

            return $f();
        }
        else
        {
            return $this->$func(...$args);
        }
    }
}