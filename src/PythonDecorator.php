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
}