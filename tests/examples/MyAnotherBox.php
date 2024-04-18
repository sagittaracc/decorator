<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\generics\aliases\U;
use Sagittaracc\PhpPythonDecorator\modules\generics\core\GenericList;
use Sagittaracc\PhpPythonDecorator\modules\generics\core\T;

#[GenericList(T::class, U::class)]
class MyAnotherBox
{
    use Decorator;

    #[U]
    public $id; // id might be either a string or a number
}