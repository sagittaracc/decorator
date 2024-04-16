<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics;

use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

class BaseGeneric extends PythonDecorator
{
    public function wrapper(mixed $object)
    {
        $generic = Generics::install($object);
        $generic->addName(static::class);

        return fn(...$args) => $generic->addEntities($args);
    }
}