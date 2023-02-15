<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm;

use Sagittaracc\PhpPythonDecorator\Decorator;

abstract class ActiveRecord
{
    use Decorator;

    private string $primaryKey;
    private null|int $id = null;
    public string $table;
    public string $returnObjectClass;
    public string $returnObjectCount;
    private $joins = [];
    public string $rawQuery;

    public static function find()
    {
        return new static();
    }

    public function all()
    {
        return $this->hasMany(static::class);
    }

    public static function findOne(int $id)
    {
        $instance = new static();
        $instance->id = $id;
        return $instance;
    }

    public function getId(): null|int
    {
        return $this->id;
    }

    protected function hasMany(string $objectClass)
    {
        $this->returnObjectClass = $objectClass;
        $this->returnObjectCount = 'many';
        return $this;
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