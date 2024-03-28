<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Log extends PythonDecorator
{
    public function wrapper(callable $callback, array $args)
    {
        echo call_user_func_array($callback, $args);
    }
}