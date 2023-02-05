<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\attributes\Route;
use Sagittaracc\PhpPythonDecorator\tests\examples\Controller;

final class RouterTest extends TestCase
{
    public function testRouter(): void
    {
        $this->assertSame('Hello world!', (new Route('/hello'))->runIn(Controller::class));
        $this->assertSame('Hello, yuriy', (new Route('/hello/yuriy'))->runIn(Controller::class));
        $this->assertNull((new Route('/notFound'))->runIn(Controller::class));
    }

    public function testRouterLog(): void
    {
        ob_start();
        (new Route('/log'))->runIn(Controller::class);
        $content = ob_get_clean();
        $this->assertSame('log', $content);
    }

    public function testMiddleware(): void
    {
        $this->expectExceptionMessage('Access denied!');
        (new Route(url: '/data', method: 'POST'))->runIn(Controller::class);
    }
}