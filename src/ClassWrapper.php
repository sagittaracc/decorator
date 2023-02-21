<?php

namespace Sagittaracc\PhpPythonDecorator;

use Sagittaracc\PhpPythonDecorator\PhpDecorator;

abstract class ClassWrapper extends PhpDecorator
{
    abstract public function getInstance();
}