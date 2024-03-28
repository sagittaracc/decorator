<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Middleware extends PythonDecorator
{
    function wrapper(callable $callback, array $args)
    {
        throw new Exception('Access denied!');
        return call_user_func_array($callback, $args);
    }
}