<?php

namespace Sagittaracc\PhpPythonDecorator\tests\generics;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\generics\BaseGeneric;

#[Attribute]
class U extends BaseGeneric
{
    public static function create()
    {
        return new U();
    }
}