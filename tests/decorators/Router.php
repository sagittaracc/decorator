<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Router extends PythonDecorator
{
    protected bool $appliable = false;

    function __construct(
        private string $route
    ) {}

    public function compareTo($object)
    {
        if (preg_match("`^$this->route$`", $object->route, $matches)) {
            array_shift($matches);
            return $matches;
        }

        return false;
    }
}