<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;

#[Attribute]
class Log extends \Sagittaracc\PhpPythonDecorator\Attribute
{
    public function main($func, ...$args)
    {
        echo $func();
    }
}