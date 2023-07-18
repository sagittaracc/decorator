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
        $request->uid = 255;
    }

    public function testFailValidation1(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\Request::id validation error! 255 is not Int8!');
        $request = new Request;
        $request->id = 255;
    }

    public function testFailValidation2(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\Request::uid validation error! 512 is not UInt8!');
        $request = new Request;
        $request->uid = 512;
    }
}