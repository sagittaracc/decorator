<?php

namespace Sagittaracc\PhpPythonDecorator\tests\service;

use Attribute;
use Exception;
use ReflectionClass;
use Sagittaracc\PhpPythonDecorator\ClassWrapperInterface;

#[Attribute]
class Di implements ClassWrapperInterface
{
    private $object;

    function __construct(
        private string $class,
        private null|array $constructor = null
    ) {}
    
    public function getInstance()
    {
        $class = new ReflectionClass($this->class);
        $constructor = $this->constructor ?? $class?->getConstructor()?->getParameters();

        $this->object = new $this->class(...$this->resolve($constructor));

        return $this->object;
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
        throw new Exception('Not supported yet!');
    }
}