<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionClass;
use ReflectionMethod;
use Sagittaracc\PhpPythonDecorator\exceptions\DecoratorError;

/**
 * Расширение понятия PHP атрибута
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
abstract class PhpAttribute
{
    /**
     * Возвращает объект на выполнение метода помеченного в $objectOrClass данным атрибутом
     * @param object|string $objectOrClass
     * @throws DecoratorError
     * @return object
     */
    public function getMethod($objectOrClass): object
    {
        $object = $function = $arguments = null;
        $class = new ReflectionClass($objectOrClass);
        $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            $attributes = $method->getAttributes(static::class);

            foreach ($attributes as $attribute) {
                $instance = $attribute->newInstance();
                $matches = $instance->matchTo($this);

                if ($matches !== false) {
                    $object = is_object($objectOrClass) ? $objectOrClass : new $objectOrClass;
                    $function = $this->getDecoratedName($method->name);
                    $arguments = $matches;

                    break 2;
                }
            }
        }

        if ($object === null && $function === null) {
            throw new DecoratorError("$this not found in $objectOrClass", 404);
        }

        return new class($object, $function, $arguments) {
            function __construct(
                private $object,
                private $function, 
                private $arguments
            ) {}

            public function run()
            {
                return call_user_func_array([$this->object, $this->function], $this->arguments);
            }
        };
    }
    /**
     * Получает значение свойства в $objectOrClass помеченное данным атрибутом
     * @param object|string $objectOrClass
     * @return null|mixed
     */
    public function getProperty($objectOrClass)
    {
        $class = new ReflectionClass($objectOrClass);
        $properties = $class->getProperties(ReflectionMethod::IS_PUBLIC);

        foreach ($properties as $property) {
            $attributes = $property->getAttributes(static::class);
            // $object = is_object($objectOrClass) ? $objectOrClass : new $objectOrClass;

            if (count($attributes) === 1) {
                return $property;
            }
        }

        return null;
    }
    /**
     * Правило преобразования имени чтобы оно требовало преобразование декоратора
     * @param string $name
     * @return string
     */
    protected function getDecoratedName(string $name): string
    {
        return "_$name";
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return '';
    }
    /**
     * Сравнивает данный атрибут с переданным
     * @param PhpAttribute $object
     * @return array|false
     */
    abstract protected function matchTo(PhpAttribute $object): array|false;
}