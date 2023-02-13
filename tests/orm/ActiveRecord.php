<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm;

abstract class ActiveRecord
{
    private int $id;

    public static function findOne(int $id)
    {
        $instance = new static();
        $instance->id = $id;
        return $instance;
    }

    public function getId(): int
    {
        return $this->id;
    }

    protected function hasMany(string $objectClass)
    {
        return [
            'self' => $this,
            'return' => $objectClass,
            'count' => 'many',
        ];
    }
}