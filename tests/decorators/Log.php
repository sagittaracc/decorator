<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonObject;

#[Attribute]
class Log extends PythonObject
{
    public function main($func, ...$args)
    {
        echo $func();
    }
}