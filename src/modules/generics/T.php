<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics;

use Attribute;
use Sagittaracc\PhpPythonDecorator\exceptions\GenericError;
use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validation;

#[Attribute]
class T extends Generic
{
    private function getEntityByValue($value)
    {
        if (!$this->initialized()) {
            return null;
        }

        $modules = $this->getObject()->scope['modules'];

        if (!isset($modules[Generics::class])) {
            return null;
        }

        $cfg = $modules[Generics::class];

        $entityIndex = array_search($value, $cfg['generics']);
        $entity = $cfg['entities'][$entityIndex] ?? null;

        return $entity;
    }

    private function checkGeneric($value)
    {
        $entity = $this->getEntityByValue(static::class);

        if (!$entity) {
            return false;
        }

        if (in_array($entity, Validation::$primitives)) {
            if ((new $entity)->validate($value)) {
                return true;
            }
            else {
                throw new GenericError;
            }
        }

        if ($value instanceof $entity) {
            return true;
        }

        throw new GenericError;
    }

    public function wrapper(mixed $object_or_value)
    {
        if ($this->checkGeneric($object_or_value)) {
            // ...
        }
        else {
            $generics = Generics::getInstanceFrom($object_or_value);
            $generics->addName(static::class);
        }

        return fn(...$args) => $generics->addEntities($args);
    }
}