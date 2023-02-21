<?php

namespace Sagittaracc\PhpPythonDecorator;

/**
 * @author <sagittaracc@gmail.com> Yuriy Arutyunyan
 */
abstract class PhpDecorator
{
    /**
     * Ссылка на объект в котором применяется данный декоратор
     * @var mixed
     */
    protected $object;
    /**
     * Название метода или свойства в объекте к которому применяется данный декоратор
     * @var string
     */
    protected string $propOrMethod;
    /**
     * Привязывается к методу или свойству объекта
     * @param mixed $object
     * @param string $propOrMethod
     * @return static
     */
    public function bindTo($object, string $propOrMethod): static
    {
        $this->object = $object;
        $this->propOrMethod = $propOrMethod;
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
        return $this->propOrMethod;
    }
}