<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\validators\In;
use Sagittaracc\PhpPythonDecorator\tests\validators\Length;
use Sagittaracc\PhpPythonDecorator\tests\validators\LessThan;
use Sagittaracc\PhpPythonDecorator\tests\validators\UInt8;

class Progress
{
    use Decorator;

    #[UInt8]
    public $max;

    #[UInt8]
    #[LessThan('max')]
    public $pos;

    #[In('progress', 'finish', 'aborted')]
    public $status;

    #[Length(32)]
    public string $caption;
}