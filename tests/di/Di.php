<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di;

use Attribute;

#[Attribute]
class Di
{
    private $object;
    private $container;

    function __construct(
        private string $class,
        private array $construct = []
    ) {}

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function createObject()
    {
        $this->object = new $this->class;
    }

    public function getObject()
    {
        return $this->object;
    }
}