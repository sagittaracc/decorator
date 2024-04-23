<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\generics\aliases\T;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\primitives\Str;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\validators\ArrayOf;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\validators\Length;
use Sagittaracc\PhpPythonDecorator\modules\validation\core\validators\Record;

#[T]
class Box
{
    use Decorator;

    #[ArrayOf(T::class)]
    public $id;

    #[Str]
    public $str;

    #[Length(3)]
    public $name;

    #[Length(4)]
    public $size;

    #[ArrayOf(T::class)]
    public $items;

    #[Record(T::class, Str::class)]
    public $map;

    public function addItem(#[T] $item)
    {
        $this->items[] = $item;
    }
}