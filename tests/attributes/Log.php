<?php

namespace Sagittaracc\PhpPythonDecorator\tests\attributes;

use Attribute;

#[Attribute]
class Log {
    public function main($func, ...$args)
    {
        return function () use ($func) {
            echo $func();
        };
    }
}