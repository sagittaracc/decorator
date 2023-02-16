<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di;

use Attribute;

#[Attribute]
class Di
{
    private $object;

    function __construct(string $classObject)
    {
        $this->object = new $classObject;
    }

    public function getObject()
    {
        return $this->object;
    }
}