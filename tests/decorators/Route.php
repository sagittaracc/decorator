<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Route extends PythonDecorator
{
    protected bool $appliable = false;

    function __construct(
        private string $route
    ) {}

    protected function compareTo($object)
    {
        if (preg_match("`^$this->route$`", $object->route, $matches)) {
            array_shift($matches);
            return $matches;
        }

        return false;
    }
}