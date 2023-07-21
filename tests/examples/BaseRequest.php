<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples;

use Sagittaracc\PhpPythonDecorator\Decorator;

class BaseRequest
{
    use Decorator;

    function __construct($request)
    {
        foreach ($request as $key => $value) {
            $this->{"_$key"} = $value;
        }
    }
}