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
     * TODO: Переделать методы запуска методов помеченных атрибутом и получение свойств помеченных атрибутом
     * (new Route('...'))->getMethod(Controller::class)->run();
     */
    public function getMethod($objectOrClass): static
    {
        return $this;
    }
    public function run()
    {
        // TODO: Если метод найден
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
    // TODO: Избавиться от данного метода
    public function getFrom($objectOrClass)
    {
        return $this->getProperty($objectOrClass);
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
    // TODO: функцию equalTo переименовать в matchTo
    // abstract protected function matchTo(PhpAttribute $object): array|false;
    /**
     * Сравнивает данный атрибут с переданным
     * @param PhpAttribute $object
     * @return array|false
     */
    abstract protected function equalTo(PhpAttribute $object): array|false;
}