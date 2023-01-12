<?php

namespace Sagittaracc\PhpPythonDecorator\Decorator;

use ReflectionMethod;

trait Decorator
{
    public function __call($func, $args)
    {
        $method = new ReflectionMethod($this, $func);
        $attributes = $method->getAttributes();

        if (count($attributes) > 0)
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