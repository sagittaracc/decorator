<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\modules\console\core\Console;
use Sagittaracc\PhpPythonDecorator\tests\examples\Controller;

final class ConsoleTest extends TestCase
{
    public function testRouter(): void
    {
        $this->assertSame(
            'Hello, Yuriy. This is from console',
            (new Console('hello'))->setParameters(['name' => 'Yuriy'])->getMethod(Controller::class)->run()
        );
    }
}