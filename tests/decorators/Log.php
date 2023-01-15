<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;

#[Attribute]
class Log
{
    public function main($func, ...$args)
    {
        echo $func();
    }
}