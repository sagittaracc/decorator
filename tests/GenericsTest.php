<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\exceptions\GenericError;
use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\tests\examples\Box;
use Sagittaracc\PhpPythonDecorator\tests\examples\MyBox;
use Sagittaracc\PhpPythonDecorator\tests\examples\Pen;
use Sagittaracc\PhpPythonDecorator\tests\examples\Pencil;
use Sagittaracc\PhpPythonDecorator\tests\generics\T;
use Sagittaracc\PhpPythonDecorator\tests\generics\U;

final class GenericsTest extends TestCase
{
    public function testBoxItemsGenericException(): void
    {
        $this->expectException(GenericError::class);

        $box = new Box();
        $box(Pencil::class);

        $pencil = new Pencil();
        $pen = new Pen();
        $box->_items = [$pencil, $pen];
    }

    public function testBoxItems(): void
    {
        $box = new Box();
        $box(Pen::class);

        $pen1 = new Pen();
        $pen2 = new Pen();
        $box->_items = [$pen1, $pen2];

        $this->assertTrue(true);
    }

    public function testGenericModule(): void
    {
        $box = new MyBox();
        $box(Pen::class, Pencil::class);

        $this->assertSame($box->scope['modules'][Generics::class]['generics'], [T::class, U::class]);
        $this->assertSame($box->scope['modules'][Generics::class]['entities'], [Pen::class, Pencil::class]);
    }
}