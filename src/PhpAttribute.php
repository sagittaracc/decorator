<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionClass;
use ReflectionMethod;
use Sagittaracc\PhpPythonDecorator\exceptions\DecoratorError;

/**
 * Расширение понятия PHP атрибута
 * @author <sagittaracc@gmail.com> Yuriy Arutyunyan
 */
abstract class PhpAttribute
{
    /**
     * Сравнивает данный атрибут с переданным
     * @param PhpAttribute $object
     * @return array|false
     */
    abstract protected function equalTo(PhpAttribute $object): array|false;
    /**
     * Выполняет метод помеченный в $objectOrClass данным атрибутом
     * @param object|string $objectOrClass
     * @throws DecoratorError
     * @return mixed
     */
    public function runIn($objectOrClass)
    {
        $class = new ReflectionClass($objectOrClass);
        $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            $attributes = $method->getAttributes(static::class);

            foreach ($attributes as $attribute) {
                $instance = $attribute->newInstance();
                $matches = $instance->equalTo($this);

                if ($matches !== false) {
                    $object = is_object($objectOrClass) ? $objectOrClass : new $objectOrClass;
                    $function = $this->getDecoratedName($method->name);
                    $arguments = $matches;

                    return call_user_func_array([$object, $function], $arguments);
                }
            }
        }

        throw new DecoratorError("$this not found in $objectOrClass", 404);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return '';
    }
    /**
     * Получает значение свойства в $objectOrClass помеченное данным атрибутом
     * @param object|string $objectOrClass
     * @return null|mixed
     */
    public function getFrom($objectOrClass)
    {
        $class = new ReflectionClass($objectOrClass);
        $properties = $class->getProperties(ReflectionMethod::IS_PUBLIC);

        foreach ($properties as $property) {
            $attributes = $property->getAttributes(static::class);
            $object = is_object($objectOrClass) ? $objectOrClass : new $objectOrClass;

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
}