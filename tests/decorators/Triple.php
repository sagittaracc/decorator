<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Triple extends PythonDecorator
{
    public function wrapper(mixed $callback)
    {
        return function (...$args) use ($callback) {
            return 3 * call_user_func_array($callback, $args);
        };
    }
}