<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class Timer extends PythonDecorator
{
    public function wrapper($func)
    {
        $time_start = microtime(true);

        $result = $func();

        $time_end = microtime(true);
        $execution_time = $time_end - $time_start;

        return "Total execution: 1; Result: $result";
        // return "Total execution: $execution_time; Result: $result";
    }
}