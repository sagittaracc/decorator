<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
final class TimerMock extends PythonDecorator
{
    public function wrapper($func)
    {
        $time_start = 1.222;

        $result = $func();

        $time_end = 2.222;
        $execution_time = $time_end - $time_start;

        return "Total execution: $execution_time; Result: $result";
    }
}