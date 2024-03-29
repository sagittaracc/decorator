<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Sagittaracc\PhpPythonDecorator\PhpDecorator;

final class Wifi extends PhpDecorator
{
    public function wrapper(callable $callback, array $args)
    {
        return 10 * call_user_func_array($callback, $args);
    }
}