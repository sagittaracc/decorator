<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionClass;
use Sagittaracc\PhpPythonDecorator\exceptions\DecoratorError;

trait Decorator
{
    public array $scope = [];

    public function __call($func, $args)
    {
        $func = ltrim($func, '_');
        $class = new ReflectionClass($this);
        $method = $class->getMethod($func);

        if (!($method->isPublic())) {
            throw new DecoratorError('Only public methods can be decorated!');
        }

        $f = fn() => $this->$func(...$args);

        $attributes = $method->getAttributes();

        foreach (array_reverse($attributes) as $attribute) {
            $instance = $attribute->newInstance();

            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this, $func);
                $f = fn() => $instance->wrapper($f);
            }

        }

        return $f();
    }

    public function __invoke()
    {
        $class = new ReflectionClass($this);

        $f = fn() => $this;

        $attributes = $class->getAttributes();

        foreach (array_reverse($attributes) as $attribute) {
            $instance = $attribute->newInstance();
            
            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this);
                $f = fn() => $instance->wrapper($f);
            }
        }

        return $f();
    }

    public function __get($name)
    {
        $name = ltrim($name, '_');
        $class = new ReflectionClass($this);
        $property = $class->getProperty($name);

        if (!($property->isPublic())) {
            throw new DecoratorError('Only public properties can be decorated!');
        }

        $f = fn() => $this->$name ?? null;

        $attributes = $property->getAttributes();

        foreach (array_reverse($attributes) as $attribute) {
            $instance = $attribute->newInstance();

            $f = fn() => $instance instanceof PythonDecorator
                ? $instance->bindTo($this, $name)->wrapper($f)
                : $instance;
        }

        $this->$name = $f();

        return $this->$name;
    }
}