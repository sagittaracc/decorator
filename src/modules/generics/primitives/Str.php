<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics\primitives;

class Str implements PrimitiveInterface
{
    public function validate($value)
    {
        return is_string($value);
    }
}