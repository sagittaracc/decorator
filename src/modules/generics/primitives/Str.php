<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics\primitives;

class Str
{
    public function validate($value)
    {
        return is_string($value);
    }
}