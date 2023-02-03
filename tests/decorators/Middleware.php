<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Middleware extends PythonDecorator
{
    public function main($func, ...$args)
    {
        throw new Exception('Access denied!');
    }
}