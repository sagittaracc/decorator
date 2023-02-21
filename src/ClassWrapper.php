<?php

namespace Sagittaracc\PhpPythonDecorator;

abstract class ClassWrapper extends PythonDecorator
{
    abstract public function getInstance();
    public function wrapper($func, $args)
    {
    }
}