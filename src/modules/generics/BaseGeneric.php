<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics;

use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

class BaseGeneric extends PythonDecorator
{
    private function getEntityByValue($value)
    {
        return null;
    }

    private function checkGeneric($value)
    {
        // $entity = $this->getEntityByValue(static::class)
        // if !entity return
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