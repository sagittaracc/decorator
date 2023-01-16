<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Cache extends PythonDecorator
{
    public function main($func, ...$args)
    {
        $parent = $this->getParent();

        if (isset($parent->scope['cache'])) {
            // return $parent->scope['cache'];
            return 'cache';
        }

        $result = $func($args);
        $parent->scope['cache'] = $result;

        return $result;
    }
}