<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Timer;

final class DecoratorTest extends TestCase
{
    public function testDecorator(): void
    {
        $timer = new Timer();

        $result = $timer->wrapper(
            function () {
                return 1 + 2;
            }
        );

        $this->assertSame('Total execution: 1; Result: 3', $result);
    }
}