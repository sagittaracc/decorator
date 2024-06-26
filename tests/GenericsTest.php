<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\exceptions\GenericError;
use Sagittaracc\PhpPythonDecorator\modules\generics\aliases\T;
use Sagittaracc\PhpPythonDecorator\modules\generics\aliases\U;
use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\primitives\Number;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\primitives\Str;
use Sagittaracc\PhpPythonDecorator\tests\examples\Box;
use Sagittaracc\PhpPythonDecorator\tests\examples\MyAnotherBox;
use Sagittaracc\PhpPythonDecorator\tests\examples\MyBox;
use Sagittaracc\PhpPythonDecorator\tests\examples\PaymentInfo;
use Sagittaracc\PhpPythonDecorator\tests\examples\Pen;
use Sagittaracc\PhpPythonDecorator\tests\examples\Pencil;

final class GenericsTest extends TestCase
{
    public function testGenericModule(): void
    {
        $box = new MyBox();
        $box(Pen::class);

        $this->assertSame($box->scope['modules'][Generics::class]['generics'], [U::class]);
        $this->assertSame($box->scope['modules'][Generics::class]['entities'], [Pen::class]);
    }

    public function testGenericList(): void
    {
        $box = new MyAnotherBox();
        $box(Pen::class, Number::class);

        $this->assertSame($box->scope['modules'][Generics::class]['generics'], [T::class, U::class]);
        $this->assertSame($box->scope['modules'][Generics::class]['entities'], [Pen::class, Number::class]);
    }

    public function testGenericSuccess(): void
    {
        $this->expectNotToPerformAssertions();

        $box = new MyAnotherBox();
        $box(Pen::class, Number::class);
        set_decorator_prop($box, 'id', 3);

        $box = new MyAnotherBox();
        $box(Pen::class, Str::class);
        set_decorator_prop($box, 'id', '3');
    }

    public function testGenericFail(): void
    {
        $this->expectException(GenericError::class);

        $box = new MyAnotherBox();
        $box(Pen::class, Number::class);
        set_decorator_prop($box, 'id', '3');
    }

    public function testPaymentInfo(): void
    {
        $this->expectException(GenericError::class);

        $paymentInfo = new PaymentInfo();
        $paymentInfo(Number::class);
        set_decorator_prop($paymentInfo, 'currency', 'rubles');
    }

    public function testArrayOf(): void
    {
        $this->expectNotToPerformAssertions();

        $box = new Box();
        $box(Pen::class);
        set_decorator_prop($box, 'id', [new Pen, new Pen]);
    }

    public function testArrayOfFail(): void
    {
        $this->expectException(GenericError::class);

        $box = new Box();
        $box(Pen::class);
        set_decorator_prop($box, 'id', [new Pen, new Pencil]);
    }

    public function testArrayOfPrimitives(): void
    {
        $this->expectNotToPerformAssertions();

        $box = new Box();
        $box(Number::class);
        set_decorator_prop($box, 'id', [1, 2, 3]);
    }

    public function testArrayOfPrimitivesFail(): void
    {
        $this->expectException(GenericError::class);

        $box = new Box();
        $box(Number::class);
        set_decorator_prop($box, 'id', [1, 2, '3']);
    }

    public function testPrimitiveStrItSelf(): void
    {
        $this->expectNotToPerformAssertions();

        $box = new Box();
        set_decorator_prop($box, 'str', 'Hello');
    }

    public function testPrimitiveStrItSelfFail(): void
    {
        $this->expectException(Exception::class);

        $box = new Box();
        set_decorator_prop($box, 'str', 1);
    }

    public function testMethodParamAttributes(): void
    {
        $this->expectNotToPerformAssertions();

        $box = new Box();
        $box(Pen::class);

        call_decorator_func_array([$box, 'addItem'], [new Pen]);
    }

    public function testMethodParamAttributesFail(): void
    {
        $this->expectException(GenericError::class);

        $box = new Box();
        $box(Pen::class);

        call_decorator_func_array([$box, 'addItem'], [new Pencil]);
    }

    public function testRecordValidator(): void
    {
        $this->expectNotToPerformAssertions();

        $box = new Box();
        $box(Number::class);

        set_decorator_prop($box, 'map', [1 => 'string-1', 2 => 'string-2']);
    }

    public function testRecordValidatorFail(): void
    {
        $this->expectException(GenericError::class);

        $box = new Box();
        $box(Str::class);

        set_decorator_prop($box, 'map', [1 => 'string-1', 2 => 'string-2']);
    }

    public function testRecordValidatorFailTwo(): void
    {
        $this->expectException(Exception::class);

        $box = new Box();
        $box(Number::class);

        set_decorator_prop($box, 'map', [1 => 2, 2 => 'string-2']);
    }

    public function testNullableValidator(): void
    {
        $this->expectNotToPerformAssertions();

        $box = new Box();

        set_decorator_prop($box, 'innerName', null);
        set_decorator_prop($box, 'innerName', 'name');
    }

    public function testNullableValidatorFail(): void
    {
        $this->expectException(Exception::class);

        $box = new Box();

        set_decorator_prop($box, 'innerName', 1);
    }
}
