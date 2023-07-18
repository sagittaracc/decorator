<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\Request;

final class ValidationTest extends TestCase
{
    public function testSuccessValidation(): void
    {
        $this->expectNotToPerformAssertions();
        $request = new Request;
        $request->id = 1;
    }

    public function testFailValidation(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\Request::id validation error! 255 is not Int8!');
        $request = new Request;
        $request->id = 255;
    }
}