<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics;

use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

class BaseGeneric extends PythonDecorator
{
    public function wrapper(mixed $object)
    {
        $generics = Generics::install($object);
        $generics->addName(static::class);

        return fn(...$args) => $generics->addEntities($args);
    }
}