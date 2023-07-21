<?php

namespace Sagittaracc\PhpPythonDecorator\tests\examples\DataTable;

use Sagittaracc\PhpPythonDecorator\Decorator;

class BaseRequest
{
    function __construct($request)
    {
        foreach ($request as $key => $value) {
            $this->{"_$key"} = $value;
        }
    }
}