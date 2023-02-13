<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm;

use Sagittaracc\PhpPythonDecorator\Decorator;

abstract class ActiveRecord
{
    use Decorator;

    private int $id;
    public string $table;
    private $joins = [];

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

    public function addJoin($column, $referencedTable, $referencedColumn)
    {
        $this->joins[] = [
            'column' => $column,
            'referencedTable' => $referencedTable,
            'referencedColumn' => $referencedColumn,
        ];
    }

    public function getJoins()
    {
        return $this->joins;
    }
}