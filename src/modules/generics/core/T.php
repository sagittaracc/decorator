<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics\core;

use Attribute;
use Sagittaracc\PhpPythonDecorator\exceptions\GenericError;
use Sagittaracc\PhpPythonDecorator\exceptions\ModuleError;
use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\modules\Module;
use Sagittaracc\PhpPythonDecorator\modules\validation\Validation;

#[Attribute]
class T extends Generic
{
    private function getEntityByValue($value)
    {
        $module = $this->getObject()->scope['modules'][Generics::class];
        $entityIndex = array_search($value, $module['generics']);
        $entity = $module['entities'][$entityIndex] ?? null;

        return $entity;
    }

    private function checkGeneric($value)
    {
        $entity = $this->getEntityByValue(static::class);

        if (in_array($entity, Validation::$primitives)) {
            if ((new $entity)->validation($value)) {
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

    private function registerGeneric($object, &$module)
    {
        if (!is_object($object)) {
            return false;
        }

        try {
            $module = Generics::getInstanceFrom($object);
        }
        catch (ModuleError $e) {
            if ($e->getCode() === Module::NOT_FOUND) {
                return false;
            }
        }

        $module->addName(static::class);

        return true;
    }

    public function wrapper(mixed $object_or_value)
    {
        $this->registerGeneric($object_or_value, $module) || $this->checkGeneric($object_or_value);

        return fn(...$args) => $module->addEntities($args);
    }
}