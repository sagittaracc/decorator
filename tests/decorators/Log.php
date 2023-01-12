<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\Decorator\DecoratorAttribute;

#[Attribute]
class Log extends DecoratorAttribute
{
    public function main($func, ...$args)
    {
        echo $func();
    }
}