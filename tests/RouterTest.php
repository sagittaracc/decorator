<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Router;
use Sagittaracc\PhpPythonDecorator\tests\examples\Controller;

final class RouterTest extends TestCase
{
    public function testRouter(): void
    {
        $this->assertSame('Hello world!', (new Router('/hello'))->runIn(Controller::class));
        $this->assertSame('Hello, yuriy', (new Router('/hello/yuriy'))->runIn(Controller::class));
        $this->assertNull((new Router('/notFound'))->runIn(Controller::class));
    }
}