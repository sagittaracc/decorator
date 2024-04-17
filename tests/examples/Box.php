<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\generics\T;
use Sagittaracc\PhpPythonDecorator\modules\generics\type\ArrayOf;

#[T]
class Box
{
    use Decorator;

    #[ArrayOf(T::class)]
    public $id;
}