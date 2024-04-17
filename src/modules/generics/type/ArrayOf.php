<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics\type;

use Attribute;
use Sagittaracc\PhpPythonDecorator\modules\generics\GenericInterface;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class ArrayOf extends PythonDecorator
{
    protected mixed $of;

    public function __construct($of)
    {
        $this->of = $of;
    }

    public function wrapper(mixed $prop)
    {
        $of = new $this->of;
        if ($of instanceof GenericInterface && $of instanceof PythonDecorator)
        {
            $of->bindTo($this->getObject());

            foreach ($prop as $item)
            {
                $of->wrapper($item);
            }
        }
        else {
            // TODO: $of instanceof PrimitiveInterface (e.g. Number, String, Boolean)
        }
    }
}