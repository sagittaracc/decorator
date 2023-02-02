<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\Controller;

final class RouterTest extends TestCase
{
    public function testRouter(): void
    {
        $controller = new Controller();

        $this->assertSame('Hello world!', $controller->action());
    }
}