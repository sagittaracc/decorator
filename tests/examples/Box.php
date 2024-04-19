<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\generics\core\T;
use Sagittaracc\PhpPythonDecorator\modules\validation\primitives\Str;
use Sagittaracc\PhpPythonDecorator\modules\validation\validators\ArrayOf;
use Sagittaracc\PhpPythonDecorator\modules\validation\validators\Length;

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
}