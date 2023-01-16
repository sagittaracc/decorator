<?php

namespace Sagittaracc\PhpPythonDecorator;

class PythonDecorator
{
    public string $className;

    public string $methodName;

    private $parent = null;

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }
}