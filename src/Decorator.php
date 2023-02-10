<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionClass;

trait Decorator
{
    public array $scope = [];

    public function __call($func, $args)
    {
        $func = ltrim($func, '_');
        $class = new ReflectionClass($this);
        $method = $class->getMethod($func);
        $attributes = array_merge($class->getAttributes(), $method->getAttributes());

        if (count($attributes) > 0)
        {
            $f = fn() => $this->$func(...$args);

            foreach (array_reverse($attributes) as $attribute) {
                $instance = $attribute->newInstance();

                if (!($instance instanceof PythonDecorator)) {
                    continue;
                }

                $instance->bindTo($this, $func);
                $f = fn() => $instance->wrapper($f, $args);
            }

            return $f();
        }
        else
        {
            return $this->$func(...$args);
        }
    }
}