<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation\primitives;

class Str
{
    public function validate($value)
    {
        return is_string($value);
    }
}