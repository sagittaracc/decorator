<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\classes\Calc;

final class CalcTest extends TestCase
{
    public function testTimerDecorator(): void
    {
        $calc = new Calc();

        ob_start();
        $calc->sum1(1, 2);
        $output = ob_get_clean();

        $this->assertSame("Total execution: 1; Result: 3", $output);
    }

    public function testNoDecorator(): void
    {
        $calc = new Calc();

        $this->assertSame(3, $calc->sum2(1, 2));
    }
}