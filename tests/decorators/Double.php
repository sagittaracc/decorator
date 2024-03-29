<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Double extends PythonDecorator
{
    public function wrapper(mixed $callback)
    {
        if (is_callable($callback)) {
            return function (...$args) use ($callback) {
                return 2 * call_user_func_array($callback, $args);
            };
        }
        else {
            return 2 * $callback;
        }
    }
}