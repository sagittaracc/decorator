<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\exceptions\DecoratorError;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Double;
use Sagittaracc\PhpPythonDecorator\tests\decorators\ExtraRoom;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Wifi;
use Sagittaracc\PhpPythonDecorator\tests\examples\Booking;
use Sagittaracc\PhpPythonDecorator\tests\examples\Calc;

final class CalcTest extends TestCase
{
    public function testTimerDecorator(): void
    {
        $calc = new Calc();

        ob_start();
        $calc->_sum1(1, 2);
        $output = ob_get_clean();

        $this->assertSame("Total execution: 1; Result: 3", $output);
    }

    public function testNoDecorator(): void
    {
        $calc = new Calc();
        $this->assertSame(3, $calc->_sum2(1, 2));
    }

    public function testNoUsingDecorator(): void
    {
        $calc = new Calc();
        $this->assertSame($calc->sum1(1, 2), $calc->sum2(1, 2));
    }

    public function testCallPrivateMethod(): void
    {
        $this->expectException(DecoratorError::class);
        $this->expectExceptionMessage('Only public methods can be decorated!');
        $calc = new Calc();
        $calc->_sum3(1, 2);
    }

    public function testSingleton(): void
    {
        $calc = new Calc();
        $this->assertSame(6, $calc->_sum4(1, 2));
        $this->assertSame(6, $calc->_sum5(1, 2));
        $this->assertSame(9, $calc->_sum6(1, 2));
    }

    public function testProperty(): void
    {
        $calc = new Calc();
        $this->assertSame(18, $calc->_sum);
    }

    public function testDecoratorOnDemand(): void
    {
        $needExtraRoom = true;
        $needWifi = true;

        $room = new Booking();
        $price = $room->getPrice();

        if ($needExtraRoom) {
            $price = (new ExtraRoom)->decorate(fn() => $price);
        }

        if ($needWifi) {
            $price = (new Wifi)->decorate(fn() => $price);
        }

        $this->assertSame(20000, $price);
    }
}