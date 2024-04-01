<?php

namespace Sagittaracc\PhpPythonDecorator;

use Attribute;
use Sagittaracc\PhpPythonDecorator\exceptions\GenericError;

#[Attribute]
class T extends PythonDecorator
{
    private function checkGeneric($item)
    {
        $object = $this->getObject();
        $scope = $object->scope;
        
        if (!$scope) {
            return false;
        }

        $tmp = $scope['generics'][static::class]['objectClass'];

        if ($item instanceof $tmp) {
            return true;
        }

        throw new GenericError;
    }

    public function wrapper($value)
    {
        if (is_array($value)) {
            foreach ($value as $item) {
                $this->checkGeneric($item);
            }
        }
        else {
            $this->checkGeneric($value);
        }

        return function(...$args) {
            $this->getObject()->scope['generics'][static::class]['objectClass'] = $args[0];
        };
    }
}