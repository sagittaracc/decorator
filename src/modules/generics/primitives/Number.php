<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics\primitives;

class Number implements PrimitiveInterface
{
    public function validate($value)
    {
        return is_numeric($value);
    }
}