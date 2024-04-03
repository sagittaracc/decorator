<?php

namespace Sagittaracc\PhpPythonDecorator;

use Attribute;
use Sagittaracc\PhpPythonDecorator\exceptions\GenericError;

#[Attribute]
class T extends PythonDecorator
{
    private function checkGeneric($item)
    {
        if (!$this->getObject()->scope) {
            return false;
        }

        if (isset($this->getObject()->scope['generics'])) {
            $tmp = $this->getObject()->scope['generics'][static::class]['objectClass'];
    
            if ($item instanceof $tmp) {
                return true;
            }
    
            throw new GenericError;
        }
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