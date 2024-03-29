<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Timer extends PythonDecorator
{
    public function wrapper(mixed $callback)
    {
        return function (...$args) use ($callback) {
            $time_start = microtime(true);
    
            $result = call_user_func_array($callback, $args);
    
            $time_end = microtime(true);
            $execution_time = $time_end - $time_start;
    
            return "Total execution: $execution_time; Result: $result";
        };
    }
}
