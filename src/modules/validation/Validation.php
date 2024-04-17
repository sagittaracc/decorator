<?php

namespace Sagittaracc\PhpPythonDecorator\modules\validation;

use Sagittaracc\PhpPythonDecorator\modules\Module;
use Sagittaracc\PhpPythonDecorator\modules\validation\primitives\Boolean;
use Sagittaracc\PhpPythonDecorator\modules\validation\primitives\Number;
use Sagittaracc\PhpPythonDecorator\modules\validation\primitives\Str;

class Validation extends Module
{
    public static $primitives = [Number::class, Str::class, Boolean::class];

    public function addError($prop, $error)
    {
        $this->object->scope['modules'][self::class]['properties'][$prop]['errors'][] = $error;
    }

    public function addWarning($prop, $warning)
    {
        $this->object->scope['modules'][self::class]['properties'][$prop]['warnings'][] = $warning;
    }
}