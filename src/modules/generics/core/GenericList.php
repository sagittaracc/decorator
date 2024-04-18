<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics\core;

use Attribute;
use Sagittaracc\PhpPythonDecorator\exceptions\GenericError;
use Sagittaracc\PhpPythonDecorator\modules\generics\Generics;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class GenericList extends PythonDecorator
{
    private array $genericList = [];

    function __construct(...$genericList)
    {
        $this->genericList = $genericList;
    }

    public function wrapper(mixed $object)
    {
        foreach ($this->genericList as $genericClass)
        {
            $generic = new $genericClass;

            if (!($generic instanceof Generic)) {
                throw new GenericError('', 400);
            }

            $generic->wrapper($object);
        }

        $generics = Generics::getInstanceFrom($object);

        return fn(...$args) => $generics->addEntities($args);
    }
}