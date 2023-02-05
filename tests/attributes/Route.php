<?php

namespace Sagittaracc\PhpPythonDecorator\tests\attributes;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PhpAttribute;

#[Attribute]
final class Route extends PhpAttribute
{
    function __construct(
        private string $route
    ) {}

    protected function equalTo($object)
    {
        if (preg_match("`^$this->route$`", $object->route, $matches)) {
            array_shift($matches);
            return $matches;
        }

        return false;
    }
}