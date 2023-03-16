<?php

namespace Sagittaracc\PhpPythonDecorator\tests\decorators;

use Sagittaracc\PhpPythonDecorator\PhpDecorator;

final class ExtraRoom extends PhpDecorator
{
    public function wrapper($func)
    {
        return 2 * $func();
    }
}