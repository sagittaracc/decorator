<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Route;
use Sagittaracc\PhpPythonDecorator\tests\examples\Controller;

final class RouterTest extends TestCase
{
    public function testRouter(): void
    {
        $this->assertSame('Hello world!', (new Route('/hello'))->runIn(Controller::class));
        $this->assertSame('Hello, yuriy', (new Route('/hello/yuriy'))->runIn(Controller::class));
        $this->assertNull((new Route('/notFound'))->runIn(Controller::class));
    }
}