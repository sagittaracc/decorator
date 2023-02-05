<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\attributes\Rpc;
use Sagittaracc\PhpPythonDecorator\tests\examples\Controller;

final class RpcTest extends TestCase
{
    public function testRpc(): void
    {
        $this->assertSame('Hello, yuriy', (new Rpc('hello', ['yuriy']))->runIn(Controller::class));
    }

    public function testFailRpcAuth(): void
    {
        $this->expectExceptionMessage('Access denied!');
        (new Rpc('data1', ['111111']))->runIn(Controller::class);
    }

    public function testSuccessRpcAuth(): void
    {
        $this->assertSame(['foo' => 'bar'], (new Rpc('data1', ['123456']))->runIn(Controller::class));
    }
}