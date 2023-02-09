<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Exception;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Auth extends PythonDecorator
{
    function wrapper($func, $args)
    {
        $jwt = $args[0];

        if ($jwt === '123456') {
            return $func(...$args);
        }

        throw new Exception('Access denied!');
    }
}