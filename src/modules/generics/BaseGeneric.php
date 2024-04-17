<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics;

use Sagittaracc\PhpPythonDecorator\exceptions\GenericError;
use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\modules\generics\primitives\Boolean;
use Sagittaracc\PhpPythonDecorator\modules\generics\primitives\Number;
use Sagittaracc\PhpPythonDecorator\modules\generics\primitives\Str;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

class BaseGeneric extends PythonDecorator implements GenericInterface
{
    protected $primitives = [
        Number::class,
        Str::class,
        Boolean::class,
    ];

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

        if (in_array($entity, $this->primitives)) {
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
            $generics = Generics::install($object_or_value);
            $generics->addName(static::class);
        }

        return fn(...$args) => $generics->addEntities($args);
    }
}