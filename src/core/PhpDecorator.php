<?php

namespace Sagittaracc\PhpPythonDecorator\core;

/**
 * Интерпретация PHP атрибута как декоратора
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
     * @return self
     */
    public function bindTo($object, string $propOrMethod): self
    {
        $this->object = $object;
        $this->propOrMethod = $propOrMethod;
        return $this;
    }
}