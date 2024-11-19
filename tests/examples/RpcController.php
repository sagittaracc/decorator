<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\modules\rpc\core\Rpc;

#[Rpc]
class RpcController
{
    use Decorator;

    public function sum($a, $b)
    {
        return $a + $b;
    }
}
