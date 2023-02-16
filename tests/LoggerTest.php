<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\Logger\Service;

final class LoggerTest extends TestCase
{
    public function testLogger(): void
    {
        $service = new Service;
        ob_start();
        $service->doStuff();

        $expectedMessage = 'Something went wrong!';
        $actualMessage = ob_get_clean();

        $this->assertMatchesRegularExpression("/$expectedMessage/", $actualMessage);
    }
}