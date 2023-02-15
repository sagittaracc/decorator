<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\di\service\StoreService;

final class DiTest extends TestCase
{
    public function testDi(): void
    {
        $service = new StoreService;
        $this->assertSame([33.333, 55.555], $service->getStoreCoordinates());
    }
}