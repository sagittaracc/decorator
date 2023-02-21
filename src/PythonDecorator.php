<?php

namespace Sagittaracc\PhpPythonDecorator;

/**
 * Расширение PHP атрибута до декоратора
 * @author <sagittaracc@gmail.com> Yuriy Arutyunyan
 */
abstract class PythonDecorator extends PhpAttribute
{
    /**
     * Ссылка на объект в котором применяется данный декоратор
     * @var object
     */
    protected object $object;
    /**
     * Название метода или свойства в объекте к которому применяется данный декоратор
     * @var string
     */
    protected string $propertyOrMethod;
    /**
     * Привязывается к методу или свойству объекта
     * @param object $object
     * @param string $propertyOrMethod
     * @return static
     */
    public function bindTo(object $object, string $propertyOrMethod): static
    {
        $this->object = $object;
        $this->propertyOrMethod = $propertyOrMethod;
        return $this;
    }
    /**
     * @return object
     */
    public function getObject(): object
    {
        return $this->object;
    }
    /**
     * TODO: Подумать как лучше назвать этот геттер
     * @return string
     */
    public function getPropertyOrMethod(): string
    {
        return $this->propertyOrMethod;
    }
    /**
     * По дефолту декораторы ни с чем не сравниваются
     * Их логика отлична от логики метаданных PHP атрибутов
     * {@inheritdoc}
     */
    protected function equalTo(PhpAttribute $object): array|false
    {
        return false;
    }
    /**
     * Враппер декоратора
     * @param string $methodOrProperty
     * @return mixed
     */
    abstract public function wrapper($methodOrProperty);
}