<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Sagittaracc\PhpPythonDecorator\PhpDecorator;

final class ExtraRoom extends PhpDecorator
{
    public function wrapper(mixed $callback)
    {
        return function (...$args) use ($callback) {
            return 2 * call_user_func_array($callback, $args);
        };
    }
}