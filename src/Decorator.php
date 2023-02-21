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

        $attributes = array_merge($class->getAttributes(), $method->getAttributes());

        if (count($attributes) > 0)
        {
            $f = fn() => $this->$func(...$args);

            foreach (array_reverse($attributes) as $attribute) {
                $instance = $attribute->newInstance();

                if ($instance instanceof PythonDecorator) {
                    $f = fn() => $instance->bindTo($this, $func)->wrapper($f);
                }

            }

            return $f();
        }
        else
        {
            return $this->$func(...$args);
        }
    }

    public function __invoke()
    {
        return $this->_pass();
    }

    public function pass(): void
    {
    }

    public function __get($name)
    {
        $name = ltrim($name, '_');

        $class = new ReflectionClass($this);
        $prop = $class->getProperty($name);
        $attributes = $prop->getAttributes();

        if (count($attributes) === 1) {
            $attribute = $attributes[0]->newInstance();

            $instance =
                $attribute instanceof ClassWrapper
                    ? $attribute->bindTo($this, $name)->getInstance()
                    : (
                        $attribute instanceof PythonDecorator
                            ? $attribute->bindTo($this, $name)->wrapper($this->$name)
                            : $attribute
                    );

            $this->$name = $instance;
        }

        return $this->$name;
    }
}