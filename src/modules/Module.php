<?php

namespace Sagittaracc\PhpPythonDecorator\modules;

use Sagittaracc\PhpPythonDecorator\exceptions\ModuleError;

class Module
{
    protected object $object;

    private function can()
    {
        return isset($this->object?->scope['modules']);
    }

    private function exists()
    {
        return isset($this->object->scope['modules'][static::class]);
    }

    private function get()
    {
        return $this->object->scope['modules'][static::class]['instance'];
    }

    private function implement()
    {
        $this->object->scope['modules'][static::class]['instance'] = $this;

        return $this;
    }

    public static function implementIn(object $object)
    {
        $module = new static;
        $module->object = $object;

        if ($module->can()) {
            return $module->exists() ? $module->get() : $module->implement();
        }

        throw new ModuleError('Cannot install module cuz object does not have a scope to install to', 400);
    }
}