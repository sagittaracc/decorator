<?php

namespace Sagittaracc\PhpPythonDecorator\tests\attributes;

use Attribute;

#[Attribute]
class Timer {
    public function main($callback)
    {
        $time_start = microtime(true);
        $result = $callback();
        $time_end = microtime(true);
        $execution_time = $time_end - $time_start;
        return "Total execution: 1; Result: $result";
        // return "Total execution: $execution_time; Result: $result";
    }
}