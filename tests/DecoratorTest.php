<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Double;

final class DecoratorTest extends TestCase
{
    public function testDoubleDecorator(): void
    {
        $decorator = new Double();

        $result = $decorator->wrapper(

            func: function ($a, $b) {
                return $a + $b;
            },

            args: [1, 2]

        );

        $this->assertSame(6, $result);
    }
}