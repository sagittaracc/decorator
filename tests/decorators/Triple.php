<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Triple extends PythonDecorator
{
    public function wrapper(callable $callback, array $args)
    {
        return 3 * call_user_func_array($callback, $args);
    }
}