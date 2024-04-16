<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\generics\GenericList;
use Sagittaracc\PhpPythonDecorator\tests\generics\T;
use Sagittaracc\PhpPythonDecorator\tests\generics\U;

#[GenericList(T::class, U::class)]
class MyAnotherBox
{
    use Decorator;
}