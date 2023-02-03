<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Middleware extends PythonDecorator
{
    protected bool $appliable = false;

    function __construct() {
        throw new Exception('Access denied!');
    }
}