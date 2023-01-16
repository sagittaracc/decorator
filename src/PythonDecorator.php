<?php

namespace Sagittaracc\PhpPythonDecorator;

class PythonDecorator
{
    private $object = null;

    public string $method;

    public function setObject($object)
    {
        $this->object = $object;
    }

    public function getObject()
    {
        return $this->object;
    }
}