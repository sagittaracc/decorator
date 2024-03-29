<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionClass;
use Sagittaracc\PhpPythonDecorator\exceptions\DecoratorError;
use function get_real_name;

/**
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
trait Decorator
{
    public array $scope = [];

    public function __call($func, $args)
    {
        $class = new ReflectionClass($this);
        $func = get_real_name($func);
        $method = $class->getMethod($func);

        if (!($method->isPublic())) {
            throw new DecoratorError('Only public methods can be decorated!');
        }

        $f = [$this, $func];

        $attributes = $method->getAttributes();
        foreach (array_reverse($attributes) as $attribute) {
            $instance = $attribute->newInstance();

            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this, $func);
                $f = $instance->wrapper($f);
            }

        }

        return call_user_func_array($f, $args);
    }

    public function __invoke()
    {
        $class = new ReflectionClass($this);

        $f = $this;

        $attributes = $class->getAttributes();
        foreach (array_reverse($attributes) as $attribute) {
            $instance = $attribute->newInstance();

            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this);
                $f = $instance->wrapper($f);
            }
        }

        return $f;
    }

    public function __get($name)
    {
        $class = new ReflectionClass($this);
        $name = get_real_name($name);
        $property = $class->getProperty($name);

        if (!($property->isPublic())) {
            throw new DecoratorError('Only public properties can be decorated!');
        }

        $f = fn() => $this->$name ?? null;
        $args = [];

        // COMMENT: Первый атрибут проперти обрабатывается по особенному
        // 1. Если он отнаследован от PythonDecorator то в него проперти оборачивается
        // 2. Если от другого класса то его инстанс присваивается этому проперти
        $attributes = array_reverse($property->getAttributes());

        $firstAttribute = array_shift($attributes);
        $firstInstance = $firstAttribute->newInstance();
        $f = fn() => $firstInstance instanceof PythonDecorator
            ? $firstInstance->bindTo($this, $name)->wrapper($f, $args)
            : $firstInstance;

        foreach ($attributes as $attribute) {
            $instance = $attribute->newInstance();

            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this, $name);
                $f = fn() => $instance->wrapper($f, $args);
            }
        }

        $this->$name = $f();

        return $this->$name;
    }

    public function __set($name, $value)
    {
        $class = new ReflectionClass($this);
        $name = get_real_name($name);
        $property = $class->getProperty($name);

        if (!($property->isPublic())) {
            throw new DecoratorError('Only public properties can be validated!');
        }

        $attributes = $property->getAttributes();
        foreach ($attributes as $attribute) {
            $instance = $attribute->newInstance();
            
            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this, $name);
                $instance->wrapper($value, []);
                $this->$name = $value;
            }
        }
    }
}