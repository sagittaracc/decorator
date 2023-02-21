<?php

namespace Sagittaracc\PhpPythonDecorator\tests\di;

use Attribute;
use Exception;
use ReflectionClass;
use Sagittaracc\PhpPythonDecorator\ClassWrapper;

#[Attribute]
class Di extends ClassWrapper
{
    private $instance;

    function __construct(
        private string $class,
        private null|array $constructor = null
    ) {}
    
    public function getInstance()
    {
        $class = new ReflectionClass($this->class);
        $constructor = $this->constructor ?? $class?->getConstructor()?->getParameters();

        $this->instance = new $this->class(...$this->resolve($constructor));

        return $this->instance;
    }

    private function resolve(null|array $constructor): array
    {
        if ($constructor === null) {
            return [];
        }

        foreach ($constructor as $i => $arg) {
            if (is_array($arg)) {
                $constructor[$i] = $this->resolve(...$arg);
            }
            else {
                $argType = $arg->getType()->getName();

                try
                {
                    $constructor[$i] = $this->containerResolver($argType);
                }
                catch (Exception $e)
                {
                    $constructor[$i] = new $argType;
                }
            }
        }

        return $constructor;
    }

    private function containerResolver(string $type)
    {
        $class = new ReflectionClass($this->object);
        $properties = $class->getProperties();
        
        foreach ($properties as $property) {
            $propertyType = $property->getType()->getName();

            if ($propertyType === $type) {
                $propertyName = '_' . $property->getName();
                return $this->object->$propertyName;
            }
        }

        throw new Exception('Can not resolve in container!');
    }
}