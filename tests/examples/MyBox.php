<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\generics\T;
use Sagittaracc\PhpPythonDecorator\tests\generics\U;

#[U]
#[T]
class MyBox
{
    use Decorator;
}