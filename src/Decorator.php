<?php

namespace Sagittaracc\PhpPythonDecorator;

use Closure;
use ReflectionClass;
use Sagittaracc\PhpPythonDecorator\exceptions\DecoratorError;

use function get_real_name;

/**
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
trait Decorator
{
    public array $scope = [
        'modules' => [],
    ];

    public function __call($func, $args)
    {
        // if ($this->scope['__attributes__']->hasCache($func)) {
        //     $attributes = $this->scope['__attributes__']->getCache($func);
        // }
        // else {
        $class = new ReflectionClass($this);
        $func = get_real_name($func);
        $method = $class->getMethod($func);

        if (!($method->isPublic())) {
            throw new DecoratorError('Only public methods can be decorated!');
        }

        $params = $method->getParameters();

        foreach ($params as $paramIndex => $param) {
            $paramAttrs = $param->getAttributes();

            foreach ($paramAttrs as $paramAttr) {
                $paramAttrInst = $paramAttr->newInstance();
                
                if ($paramAttrInst instanceof PythonDecorator) {
                    $paramAttrInst->bindTo($this)->wrapper($args[$paramIndex]);
                }
            }
        }

        $attributes = $method->getAttributes();
        // }

        $f = [$this, $func];
        foreach (array_reverse($attributes) as $attribute) {
            $instance = $attribute->newInstance();

            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this, $func);
                $f = $instance->wrapper($f);
            }
        }

        return call_user_func_array($f, $args);
    }

    public function __invoke(...$args)
    {
        $class = new ReflectionClass($this);
        $attributes = $class->getAttributes();

        $f = $this;
        foreach (array_reverse($attributes) as $attribute) {
            $instance = $attribute->newInstance();

            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this);
                $f = $instance->wrapper($f);
            }
        }

        return
            is_callable($f) && $f instanceof Closure
                ? $f(...$args)
                : $f;
    }

    public function __get($name)
    {
        $class = new ReflectionClass($this);
        $name = get_real_name($name);
        $property = $class->getProperty($name);

        if (!($property->isPublic())) {
            throw new DecoratorError('Only public properties can be decorated!');
        }

        // COMMENT: Первый атрибут проперти обрабатывается по особенному
        // 1. Если он отнаследован от PythonDecorator то в него проперти оборачивается
        // 2. Если от другого класса то его инстанс присваивается этому проперти
        $attributes = array_reverse($property->getAttributes());

        $f = $this->$name ?? null;
        $firstAttribute = array_shift($attributes);
        $firstInstance = $firstAttribute->newInstance();
        $f = $firstInstance instanceof PythonDecorator
            ? $firstInstance->bindTo($this, $name)->wrapper($f)
            : $firstInstance;

        foreach ($attributes as $attribute) {
            $instance = $attribute->newInstance();

            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this, $name);
                $f = $instance->wrapper($f);
            }
        }

        $this->$name = $f;

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

        $f = $value;
        foreach ($attributes as $attribute) {
            $instance = $attribute->newInstance();
            
            if ($instance instanceof PythonDecorator) {
                $instance->bindTo($this, $name)->wrapper($f);
            }
        }

        $this->$name = $f;
    }
}