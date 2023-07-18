<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\decorators\Int8;
use Sagittaracc\PhpPythonDecorator\tests\decorators\UInt8;

class Request
{
    use Decorator;

    #[Int8]
    protected $id;

    #[UInt8]
    protected $uid;
}