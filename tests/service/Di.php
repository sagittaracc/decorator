<?php

namespace Sagittaracc\PhpPythonDecorator\tests\service;

use Attribute;
use Sagittaracc\PhpPythonDecorator\ClassWrapperInterface;

#[Attribute]
class Di implements ClassWrapperInterface
{
    private $object;

    function __construct(
        private string $class
    ) {}
    
    public function getInstance()
    {
        $this->object = new $this->class;
        return $this->object;
    }
}