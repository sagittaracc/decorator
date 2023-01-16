<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Cache extends PythonDecorator
{
    public function main($func, ...$args)
    {
        $object = $this->getObject();

        if (isset($object->scope[$this->method])) {
            // return $parent->scope[$this->method];
            return 'cache';
        }

        $result = $func($args);
        $object->scope[$this->method] = $result;

        return $result;
    }
}