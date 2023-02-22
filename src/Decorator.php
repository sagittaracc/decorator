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
        $attributes = array_reverse($class->getAttributes());
        $attribute = array_shift($attributes);
        $instance = $attribute->newInstance();
        $instance->bindTo($this);
        $f = fn() => $instance instanceof PythonDecorator ? $instance->wrapper($this): null;

        foreach ($attributes as $attribute) {
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

        $propertyValue = $this->$name ?? null;

        $attributes = array_reverse($property->getAttributes());
        $attribute = array_shift($attributes);
        $instance = $attribute->newInstance();
        $instance->bindTo($this, $name);
        $f = fn() => $instance instanceof PythonDecorator ? $instance->wrapper($propertyValue) : $instance;

        foreach ($attributes as $attribute) {
            $instance = $attribute->newInstance();
            $instance->bindTo($this, $name);
            $f = fn() => $instance instanceof PythonDecorator ? $instance->wrapper($f) : $instance;
        }

        $this->$name = $f();

        return $this->$name;
    }
}