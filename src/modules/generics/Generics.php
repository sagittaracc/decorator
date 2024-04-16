<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics;

use Sagittaracc\PhpPythonDecorator\modules\Module;

class Generics extends Module
{
    public function addName($name)
    {
        $this->object->scope['modules'][self::class]['generics'][] = $name;
    }

    public function addEntities($entities)
    {
        $this->object->scope['modules'][self::class]['entities'] = $entities;
    }
}