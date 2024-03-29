<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Sagittaracc\PhpPythonDecorator\PhpDecorator;

final class InlineTimerMock extends PhpDecorator
{
    public function wrapper(mixed $callback)
    {
        return function (...$args) use ($callback) {
            $time_start = 1.222;
    
            $result = call_user_func_array($callback, $args);
    
            $time_end = 2.222;
            $execution_time = $time_end - $time_start;
    
            return "Total execution: $execution_time; Result: $result";
        };
    }
}