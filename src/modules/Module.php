<?php

namespace Sagittaracc\PhpPythonDecorator\modules;

use Sagittaracc\PhpPythonDecorator\exceptions\ModuleError;

class Module
{
    protected object $object;

    private function canImplement()
    {
        return isset($this->object?->scope['modules']);
    }

    private function hasInstance()
    {
        return isset($this->object->scope['modules'][static::class]);
    }

    private function getInstance()
    {
        return $this->object->scope['modules'][static::class]['instance'];
    }

    private function setInstance()
    {
        $this->object->scope['modules'][static::class]['instance'] = $this;

        return $this;
    }

    public static function getInstanceFrom(object $object)
    {
        $module = new static;
        $module->object = $object;

        if (!$module->canImplement()) {
            throw new ModuleError('', 400); // TODO: Придумать текст исключения
        }

        if (!$module->hasInstance()) {
            $module->setInstance();
        }

        return $module->getInstance();
    }
}