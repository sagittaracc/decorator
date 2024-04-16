<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics\primitives;

class Boolean
{
    public function validate($value)
    {
        return is_bool($value);
    }
}