<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\examples\Request;

final class ValidationTest extends TestCase
{
    private Request $request;

    protected function setUp(): void
    {
        $this->request = new Request;
    }

    public function testSuccessValidation(): void
    {
        $this->request->_id = 1;
        $this->request->_uid = 255;
        $this->assertSame(1, $this->request->id);
        $this->assertSame(255, $this->request->uid);
    }

    public function testFailValidation1(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\Request::id validation error! 255 is not Int8!');
        $this->request->_id = 255;
    }

    public function testFailValidation2(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\Request::uid validation error! `512` is not satisfied by UInt8!');
        $this->request->_uid = 512;
    }

    public function testSuccessValidation3(): void
    {
        $this->request->_method = 'login';
        $this->assertSame('login', $this->request->method);
    }

    public function testFailValidation4(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\Request::method validation error! `method` is not satisfied by Length!');
        $this->request->_method = 'method';
    }

    public function testSuccessValidation5(): void
    {
        $this->request->_params = [1,2,3];
        $this->assertSame([1,2,3], $this->request->params);
    }

    public function testFailValidation6(): void
    {
        $this->expectExceptionMessage('Sagittaracc\PhpPythonDecorator\tests\examples\Request::params validation error! `[1,2,300]` is not satisfied by ArrayOf(UInt8)!');
        $this->request->_params = [1,2,300];
    }
}