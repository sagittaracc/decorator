<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\T;

#[T]
class Box
{
    use Decorator;

    #[T]
    public array $items;
}