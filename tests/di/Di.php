<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di;

use Attribute;
use ReflectionClass;

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
        $args = [];
        $container = new ReflectionClass($this->container);
        $properties = $container->getProperties();
        foreach ($properties as $property)
        {
            $attributes = $property->getAttributes(self::class);
            foreach ($attributes as $attribute)
            {
                $propertyType = $property->getType()->getName();
                if (in_array($propertyType, $this->construct))
                {
                    $arg = $attribute->newInstance();
                    $arg->setContainer($this);
                    $arg->createObject();
                    $args[] = $arg->getObject();
                }
            }
        }
        $this->object = new $this->class(...$args);
    }

    public function getObject()
    {
        return $this->object;
    }
}