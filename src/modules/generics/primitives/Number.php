<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics\primitives;

class Number
{
    public function validate($value)
    {
        return is_int($value);
    }
}