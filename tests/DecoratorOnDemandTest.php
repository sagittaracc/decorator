<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\decorators\ExtraRoom;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Wifi;
use Sagittaracc\PhpPythonDecorator\tests\examples\Booking;

final class DecoratorOnDemandTest extends TestCase
{
    public function testDecoratorOnDemand(): void
    {
        $needExtraRoom = true;
        $needWifi = true;

        $room = new Booking();
        $price = $room->getPrice();

        if ($needExtraRoom) {
            $price = (new ExtraRoom)->decorate($price);
        }

        if ($needWifi) {
            $price = (new Wifi)->decorate($price);
        }

        $this->assertSame(20000, $price);
    }
}