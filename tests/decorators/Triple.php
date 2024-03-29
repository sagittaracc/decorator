<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Triple extends PythonDecorator
{
    public function wrapper(mixed $callback)
    {
        if (is_callable($callback)) {
            return function (...$args) use ($callback) {
                return 3 * call_user_func_array($callback, $args);
            };
        }
        else {
            return 3 * $callback;
        }
    }
}