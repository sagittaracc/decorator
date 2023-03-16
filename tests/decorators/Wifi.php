<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Sagittaracc\PhpPythonDecorator\PhpDecorator;

final class Wifi extends PhpDecorator
{
    public function wrapper($func)
    {
        return 10 * $func();
    }
}