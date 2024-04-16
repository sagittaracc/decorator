<?php

namespace Sagittaracc\PhpPythonDecorator;

/**
 * Расширение PHP атрибута до декоратора
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
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
    protected ?string $propertyOrMethod;
    /**
     * Привязывается к методу или свойству объекта
     * @param object $object
     * @param ?string $propertyOrMethod
     * @return static
     */
    public function bindTo(object $object, ?string $propertyOrMethod = null): static
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
     * 
     */
    public function initialized(): bool
    {
        return isset($this->object);
    }
    /**
     * Получает название свойства или метода к которому привязан декоратор
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
    protected function matchTo(PhpAttribute $object): array|false
    {
        return false;
    }
    /**
     * Враппер декоратора
     * @return mixed
     */
    abstract public function wrapper(mixed $callback_or_object_or_property_or_value);
}