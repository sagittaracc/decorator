<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\exceptions\GenericError;
use Sagittaracc\PhpPythonDecorator\modules\generics\aliases\A;
use Sagittaracc\PhpPythonDecorator\modules\generics\aliases\T;
use Sagittaracc\PhpPythonDecorator\modules\generics\Generic;
use Sagittaracc\PhpPythonDecorator\tests\examples\Box;
use Sagittaracc\PhpPythonDecorator\tests\examples\MyBox;
use Sagittaracc\PhpPythonDecorator\tests\examples\Pen;
use Sagittaracc\PhpPythonDecorator\tests\examples\Pencil;

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

        $this->assertSame(
            $box->scope['modules'][Generic::class]['match'],
            [
                T::class => Pen::class,
                A::class => Pencil::class
            ]
        );
    }
}