<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\Data;

final class DataTest extends TestCase
{
    public function testDto(): void
    {
        $data = new Data();

        $expensiveData = $data->_getExpensiveData();
        $this->assertSame(['foo' => 'bar'], $expensiveData);

        $expensiveData = $data->_getExpensiveData();
        $this->assertSame('cache', $expensiveData);

        // Ignore cache
        $expensiveData = $data->getExpensiveData();
        $this->assertSame(['foo' => 'bar'], $expensiveData);
    }
}