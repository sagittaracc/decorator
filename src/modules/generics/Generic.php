<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics;

use Sagittaracc\PhpPythonDecorator\modules\Module;

class Generic extends Module
{
    public function addName($name)
    {
        $this->object->scope['modules'][self::class]['generics'][] = $name;
    }

    public function addEntities($entities)
    {
        $this->object->scope['modules'][self::class]['entities'] = $entities;

        foreach ($entities as $i => $entity) {
            $name = $this->object->scope['modules'][self::class]['generics'][$i];
            $this->object->scope['modules'][self::class]['match'][$name] = $entity;
        }
    }
}