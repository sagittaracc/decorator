<?php

namespace Sagittaracc\PhpPythonDecorator;

/**
 * Декорация НЕ через атрибут, а через враппер
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
abstract class PhpDecorator extends PythonDecorator
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public function decorate($data)
    {
        return $this->wrapper(fn() => $data);
    }
}