<?php

namespace Sagittaracc\PhpPythonDecorator;

use ReflectionClass;
use ReflectionMethod;

class PhpAttribute
{
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
                if ($attribute->getName() !== get_class($this)) {
                    continue;
                }

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