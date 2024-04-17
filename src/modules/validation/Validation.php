<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation;

use Sagittaracc\PhpPythonDecorator\modules\Module;

class Validation extends Module
{
    public function addError($prop, $error)
    {
        $this->object->scope['modules'][self::class]['properties'][$prop]['errors'][] = $error;
    }

    public function addWarning($prop, $warning)
    {
        $this->object->scope['modules'][self::class]['properties'][$prop]['warnings'][] = $warning;
    }
}