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
     * @return bool
     */
    abstract protected function equalTo(PhpAttribute $object);
    /**
     * Выполняет метод помеченный в $objectClass данным атрибутом
     * @param string $objectClass
     * @return null|mixed
     */
    public function runIn($objectClass)
    {
        /**
         * $objectClass or $object
         * TODO: Сделать чтобы можно было передать как объект класса так и сам класс
         */
        $class = new ReflectionClass($objectClass);
        $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            $attributes = $method->getAttributes();

            foreach ($attributes as $attribute) {
                if ($attribute->getName() !== get_class($this)) {
                    continue;
                }

                $instance = $attribute->newInstance();
                $matches = $instance->equalTo($this);
                if ($matches !== false) {
                    /**
                     * Чтобы здесь можно было либо создать его
                     * new $objectClass
                     * либо вызвать в самом объекте
                     */
                    return call_user_func_array([new $objectClass, "_{$method->name}"], $matches);
                }
            }
        }

        return null;
    }
}