<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Double extends PythonDecorator
{
    public function wrapper(mixed $callback, array $args)
    {
        return 2 * call_user_func_array($callback, $args);
    }
}