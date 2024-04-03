<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics\aliases;

use Sagittaracc\PhpPythonDecorator\modules\generics\Generic;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

class Base extends PythonDecorator
{
    public function wrapper(mixed $callback_or_object_or_property_or_value)
    {
        $generic = Generic::install($this->getObject());
        $generic->addName(static::class);
    }
}