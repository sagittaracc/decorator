<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Timer extends PythonDecorator
{
    public function wrapper(callable $callback, array $args)
    {
        $time_start = microtime(true);

        $result = call_user_func_array($callback, $args);

        $time_end = microtime(true);
        $execution_time = $time_end - $time_start;

        return "Total execution: $execution_time; Result: $result";
    }
}
