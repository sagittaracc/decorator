<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionClass;
use ReflectionMethod;

/**
 * @author <sagittaracc@gmail.com> Yuriy Arutyunyan
 */
class PythonDecorator
{
    /**
     * Ссылка на объект в котором применяется декоратор
     * @var mixed
     */
    private $object = null;
    /**
     * Название метода в объекте к которому применяется декоратор
     * @var string
     */
    private string $method;
    /**
     * Указывает тип применения декоратора
     * @var boolean
     * true - тогда декоратор применяется к вызываемому методу
     * false - тогда по данному декоратору вызывается метод
     */
    protected bool $appliable = true;
    /**
     * Привязывает декоратор к методу объекта
     * @param mixed $object
     * @param string $method
     * @return self
     */
    public function bindTo($object, string $method): self
    {
        $this->object = $object;
        $this->method = $method;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
    /**
     * @return bool
     */
    public function isAppliable(): bool
    {
        return $this->appliable;
    }
    /**
     * @return bool
     */
    protected function compareTo($object)
    {
        return false;
    }
    /**
     * Выполняет метод декорируемый в $objectClass данным декоратором
     * @param string $objectClass
     * @return mixed
     */
    public function runIn($objectClass)
    {
        $class = new ReflectionClass($objectClass);
        $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            $attributes = $method->getAttributes();

            foreach ($attributes as $attribute) {
                $instance = $attribute->newInstance();
                $matches = $instance->compareTo($this);
                if ($matches !== false) {
                    return call_user_func_array([new $method->class, "_{$method->name}"], $matches);
                }
            }
        }

        return null;
    }
}