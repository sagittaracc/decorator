<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionClass;

trait Decorator
{
    public array $scope = [];

    public function __call($func, $args)
    {
        $class = new ReflectionClass($this);
        $classAttributes = $class->getAttributes();

        $func = ltrim($func, '_');
        $method = $class->getMethod($func);
        $methodAttributes = $method->getAttributes();

        $attributes = array_merge($classAttributes, $methodAttributes);

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