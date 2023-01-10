<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\classes\Calc;

final class TimerTest extends TestCase
{
    public function testTimerDecorator(): void
    {
        $calc = new Calc();
        $this->assertSame("Total execution: 1; Result: 3", $calc->run('sum1', 1, 2));
    }

    public function testNoDecorator(): void
    {
        $calc = new Calc();
        $this->assertSame(3, $calc->run('sum2', 1, 2));
    }
}