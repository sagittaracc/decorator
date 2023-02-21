<?php

namespace Sagittaracc\PhpPythonDecorator;

use Sagittaracc\PhpPythonDecorator\PhpDecorator;

/**
 * Интерпретация PHP атрибута как Python декоратора
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
abstract class PythonDecorator extends PhpDecorator
{
    /**
     * Враппер декоратора
     * @param string $func
     * @param array $args
     * @return mixed
     */
    abstract public function wrapper($func, $args);
}