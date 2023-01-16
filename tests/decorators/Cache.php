<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonObject;

#[Attribute]
class Cache extends PythonObject
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