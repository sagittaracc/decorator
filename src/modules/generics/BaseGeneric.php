<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics;

use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

class BaseGeneric extends PythonDecorator
{
    public function wrapper(mixed $callback_or_object_or_property_or_value)
    {
        $generic = Generics::install($this->getObject());
        $generic->addName(static::class);

        return fn(...$args) => $generic->addEntities($args);
    }
}