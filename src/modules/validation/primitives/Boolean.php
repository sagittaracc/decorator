<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\primitives;

class Boolean
{
    public function validate($value)
    {
        return is_bool($value);
    }
}