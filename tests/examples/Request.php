<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\validators\Int8;
use Sagittaracc\PhpPythonDecorator\tests\validators\Length;
use Sagittaracc\PhpPythonDecorator\tests\validators\Str;
use Sagittaracc\PhpPythonDecorator\tests\validators\UInt8;

class Request
{
    use Decorator;

    #[Int8]
    public $id;

    #[UInt8]
    public $uid;

    #[Str]
    #[Length(5)]
    public $method;
}