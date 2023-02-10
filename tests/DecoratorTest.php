<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Double;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Timer;

final class DecoratorTest extends TestCase
{
    public function testDoubleDecorator(): void
    {
        $timer = new Timer();
        $double = new Double();

        $result = $timer->wrapper(

            func: function ($double) {

                return $double->wrapper(

                    func: function ($a, $b) {
                        return $a + $b;
                    },

                    args: [1, 2]
                );

            },
            
            args: [$double]

        );

        $this->assertSame('Total execution: 1; Result: 6', $result);
    }
}