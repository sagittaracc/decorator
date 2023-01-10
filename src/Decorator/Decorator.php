<?php

namespace Sagittaracc\PhpPythonDecorator\Decorator;

use ReflectionMethod;

trait Decorator
{
    public function run(string $func, ...$args)
    {
        $method = new ReflectionMethod($this, $func);
        $attributes = $method->getAttributes();

        if (count($attributes) > 0) {
            foreach ($attributes as $attribute) {
                $instance = $attribute->newInstance();
                return $instance->main(fn() => $this->$func(...$args));
            }
        }
        else {
            return $this->$func(...$args);
        }
    }
}