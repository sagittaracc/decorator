<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\RpcController;

final class RpcTest extends TestCase
{
    public function testRpc(): void
    {
        ob_start();

        // STUB
        $requestBody = '{"id":1,"method":"sum","params":[1,2]}';

        $controller = new RpcController();
        $controller($requestBody);

        $this->assertSame('{"json-rpc":"2.0","id":1,"result":3}', ob_get_clean());
    }
}
