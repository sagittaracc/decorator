<?php

namespace Sagittaracc\PhpPythonDecorator;

/**
 * Интерпретация PHP атрибута как Python декоратора
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
abstract class PythonDecorator
{
    /**
     * Ссылка на объект в котором применяется данный декоратор
     * @var mixed
     */
    private $object = null;
    /**
     * Название метода в объекте к которому применяется данный декоратор
     * @var string
     */
    private string $method;
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
     * Враппер декоратора
     * @param string $func
     * @param array $args
     * @return mixed
     */
    abstract public function wrapper($func, $args);
}