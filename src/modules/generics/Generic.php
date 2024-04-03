<?php

namespace Sagittaracc\PhpPythonDecorator\modules\generics;

use Sagittaracc\PhpPythonDecorator\modules\Module;

class Generic extends Module
{
    public function addName($name)
    {
        $this->object->scope['modules'][self::class]['generics'][] = $name;
    }
}