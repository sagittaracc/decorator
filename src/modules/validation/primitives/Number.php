<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\primitives;

class Number
{
    public function validate($value)
    {
        return is_int($value);
    }
}