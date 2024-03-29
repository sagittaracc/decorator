<?php

namespace Sagittaracc\PhpPythonDecorator;

/**
 * Декорация НЕ через атрибут, а через враппер
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
abstract class PhpDecorator extends PythonDecorator
{
    /**
     * @param mixed $callback_or_object_or_property_or_value
     * @return mixed
     */
    public function decorate($callback_or_object_or_property_or_value)
    {
        return $this->wrapper($callback_or_object_or_property_or_value);
    }
}