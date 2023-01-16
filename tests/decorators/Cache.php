<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Cache extends PythonDecorator
{
    public function main($func, ...$args)
    {
        if (isset($this->parent->scope['cache'])) {
            // return $this->parent->scope['cache'];
            return 'cache';
        }

        $result = $func($args);
        $this->parent->scope['cache'] = $result;

        return $result;
    }
}