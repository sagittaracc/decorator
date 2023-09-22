<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\attributes\Route;
use Sagittaracc\PhpPythonDecorator\tests\examples\Controller;

final class RouterTest extends TestCase
{
    public function testRouter(): void
    {
        $this->assertSame(
            'Hello, guest',
            (new Route('/hello'))->look(Controller::class)->run()
        );

        $this->assertSame(
            'Hello, yuriy',
            (new Route('/hello/yuriy'))->look(Controller::class)->run()
        );
    }

    public function testRouteInInstansiateController(): void
    {
        $this->assertSame(
            'Hello, guest',
            (new Route('/hello'))->look(new Controller)->run()
        );
    }

    public function testNotFoundRoute(): void
    {
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage('GET /notFound not found in Sagittaracc\PhpPythonDecorator\tests\examples\Controller');
        (new Route('/notFound'))->look(Controller::class)->run();
    }

    public function testRouterLog(): void
    {
        ob_start();
        (new Route('/log'))->look(Controller::class)->run();
        $content = ob_get_clean();
        $this->assertSame('log', $content);
    }

    public function testMiddleware(): void
    {
        $this->expectExceptionMessage('Access denied!');
        (new Route(url: '/data', method: 'POST'))->look(Controller::class)->run();
    }
}