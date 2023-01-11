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

    public function testFailedRetryDecorator(): void
    {
        $this->expectExceptionMessage('2 attempts was not enough!');

        $calc = new Calc();

        $calc->div1(2, 1);
    }

    public function testSuccessfulRetryDecorator(): void
    {
        $calc = new Calc();

        $result = $calc->div2(4, 2);

        $this->assertSame(2, $result['result']);
        $this->assertSame(3, $result['attempts']);
    }
}