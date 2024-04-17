<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\generics\type\ArrayOf;
use Sagittaracc\PhpPythonDecorator\tests\generics\T;

#[T]
class Box
{
    use Decorator;

    #[ArrayOf(T::class)]
    public $id;
}