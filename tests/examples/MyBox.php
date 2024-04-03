<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\generics\aliases\A;
use Sagittaracc\PhpPythonDecorator\modules\generics\aliases\T;

#[A]
#[T]
class MyBox
{
    use Decorator;
}