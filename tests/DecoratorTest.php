<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Double;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Timer;

final class DecoratorTest extends TestCase
{
    public function testDecorator(): void
    {
        $timer = new Timer();
        $double = new Double();

        $result = $timer->wrapper(

            function () use ($double) {

                return $double->wrapper(

                    function () {
                        return 1 + 2;
                    }
                );

            }

        );

        $this->assertSame('Total execution: 1; Result: 6', $result);
    }
}