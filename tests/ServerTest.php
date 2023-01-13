<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\Server;

final class ServerTest extends TestCase
{
    public function testFailRetryDecorator(): void
    {
        $this->expectExceptionMessage('2 attempts was not enough!');

        $server = new Server();

        $server->_failConnect();
    }

    public function testSuccessRetryDecorator(): void
    {
        $server = new Server();

        $result = $server->_successConnect();

        $this->assertTrue($result['result']);
        $this->assertSame(3, $result['attempts']);
    }
}