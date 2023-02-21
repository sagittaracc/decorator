<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionClass;
use ReflectionMethod;

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
     * @return null|mixed
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

        return null;
    }
    /**
     * Правило преобразования имени чтобы оно требовало преобразование декоратора
     * @param string $name
     */
    protected function getDecoratedName(string $name): string
    {
        return "_$name";
    }
}