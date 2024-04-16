<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics\primitives;

class Boolean implements PrimitiveInterface
{
    public function validate($value)
    {
        return is_bool($value);
    }
}