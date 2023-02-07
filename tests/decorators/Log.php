<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Log extends PythonDecorator
{
    public function wrapper($func, ...$args)
    {
        echo $func();
    }
}