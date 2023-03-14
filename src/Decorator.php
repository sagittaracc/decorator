<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionClass;
use Sagittaracc\PhpPythonDecorator\exceptions\DecoratorError;

/**
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
trait Decorator
{
    public array $scope = [];

    public function __call($func, $args)
    {
        $class = new ReflectionClass($this);
        $func = ltrim($func, '_');
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
        $class = new ReflectionClass($this);
        $name = ltrim($name, '_');
        $property = $class->getProperty($name);

        if (!($property->isPublic())) {
            throw new DecoratorError('Only public properties can be decorated!');
        }

        $f = fn() => $this->$name ?? null;
        $attributes = array_reverse($property->getAttributes());

        // Первый атрибут проперти обрабатывается по особенному
        // 1. Если он отнаследован от PythonDecorator то в него проперти оборачивается
        // 2. Если от другого класса то его инстанс присваивается этому проперти
        $firstAttribute = array_shift($attributes);
        $firstInstance = $firstAttribute->newInstance();
        $f = fn() => $firstInstance instanceof PythonDecorator
            ? $firstInstance->bindTo($this, $name)->wrapper($f)
            : $firstInstance;

        foreach ($attributes as $attribute) {
            $instance = $attribute->newInstance();

            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this, $name);
                $f = fn() => $instance->wrapper($f);
            }
        }

        $this->$name = $f();

        return $this->$name;
    }
}