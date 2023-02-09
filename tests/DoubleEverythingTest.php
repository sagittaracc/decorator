<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\DoubleEverything;

final class DoubleEverythingTest extends TestCase
{
    public function testTimerDecorator(): void
    {
        $calc = new DoubleEverything();
        $this->assertSame(12, $calc->_sum(1, 2));
    }
}