<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\service\StoreService;

final class ServiceTest extends TestCase
{
    public function testService(): void
    {
        $service = new StoreService;
        // $this->assertSame([33.333, 55.555], $service->getStoreCoordinates());
        $this->assertSame([33.333, 55.555], $service->getStoreCoordinates1());
    }
}