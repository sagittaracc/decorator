<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\Decorator\DecoratorAttribute;

#[Attribute]
class Timer extends DecoratorAttribute
{
    public function main($func, ...$args)
    {
        $time_start = microtime(true);

        $result = $func($args);

        $time_end = microtime(true);
        $execution_time = $time_end - $time_start;

        return "Total execution: 1; Result: $result";
        // return "Total execution: $execution_time; Result: $result";
    }
}