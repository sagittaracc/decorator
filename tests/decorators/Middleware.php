<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Middleware extends PythonDecorator
{
    function wrapper($func)
    {
        throw new Exception('Access denied!');
        return $func();
    }
}