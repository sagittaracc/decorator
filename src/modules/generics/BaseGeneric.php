<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics;

use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

class BaseGeneric extends PythonDecorator
{
    private function checkGeneric($value)
    {
        // $index = index_of(static::class, $this->getObject()->scope['modules'][Generics::class]['generics'])
        // $entity = $box->scope['modules'][Generics::class]['entities'][$index]
        // if Validation then check validation
        // else value or value item instance of entity
        return true;
    }

    public function wrapper(mixed $object_or_value)
    {
        $this->checkGeneric($object_or_value);

        $generics = Generics::install($object_or_value);
        $generics->addName(static::class);

        return fn(...$args) => $generics->addEntities($args);
    }
}