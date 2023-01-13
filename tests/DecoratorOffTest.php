<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\CalcDecoratorOff;

final class DecoratorOffTest extends TestCase
{
    public function testDecoratorOff(): void
    {
        $calc = new CalcDecoratorOff();
        $this->assertSame($calc->sum1(1, 2), $calc->sum2(1, 2));
    }
}