<?php

namespace Sagittaracc\PhpPythonDecorator\modules;

class Module
{
    protected object $object;

    public static function install(object $object)
    {
        if (isset($object->scope['modules'][static::class])) {
            $instance = $object->scope['modules'][static::class]['instance'];
        }
        else {
            $instance = new static();
            $instance->object = $object;
            $object->scope['modules'][static::class]['instance'] = $instance;
        }

        return $instance;
    }
}