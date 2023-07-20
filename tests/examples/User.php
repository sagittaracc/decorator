<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\validators\UInt8;

class User
{
    use Decorator;

    #[UInt8]
    public $id;
}