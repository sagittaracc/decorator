<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionMethod;

trait Decorator
{
    public string $className;

    public string $methodName;

    public function __call($func, $args)
    {
        $func = ltrim($func, '_');
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