<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Middleware extends PythonDecorator
{
    function wrapper(mixed $callback)
    {
        return function (...$args) use ($callback) {
            throw new Exception('Access denied!');
            return call_user_func_array($callback, $args);
        };
    }
}