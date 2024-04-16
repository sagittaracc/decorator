<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\exceptions\GenericError;
use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\modules\generics\primitives\Number;
use Sagittaracc\PhpPythonDecorator\modules\generics\primitives\Str;
use Sagittaracc\PhpPythonDecorator\tests\examples\MyAnotherBox;
use Sagittaracc\PhpPythonDecorator\tests\examples\MyBox;
use Sagittaracc\PhpPythonDecorator\tests\examples\Pen;
use Sagittaracc\PhpPythonDecorator\tests\generics\T;
use Sagittaracc\PhpPythonDecorator\tests\generics\U;

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
        $box(Pen::class, Str::class);
        set_decorator_prop($box, 'id', 3);
    }
}