<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionMethod;

trait Decorator
{
    public array $scope = [];

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

                if (!($instance->isAppliable())) {
                    continue;
                }

                $instance->bindTo($this, $func);
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