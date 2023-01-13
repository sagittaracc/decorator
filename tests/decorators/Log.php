<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Log extends PythonDecorator
{
    public function main($func, ...$args)
    {
        echo $func();
    }
}