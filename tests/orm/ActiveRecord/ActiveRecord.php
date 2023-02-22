<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord;

use Sagittaracc\PhpPythonDecorator\Decorator;
use Sagittaracc\PhpPythonDecorator\tests\orm\Decorators\PDO;

abstract class ActiveRecord
{
    use Decorator;

    #[PDO('mysql:host=localhost;dbname=test', 'root', '')]
    // TODO: #[Singleton]
    public $db;

    protected int $id;

    protected string $table;

    protected string $primaryKey;

    protected string $returnObjectClass;

    protected string $returnObjectCount;

    protected string $reference;

    public function getConnection()
    {
        return $this->_db->connection;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setPrimaryKey(string $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }

    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    public function setReturnObjectClass(string $returnObjectClass): void
    {
        $this->returnObjectClass = $returnObjectClass;
    }

    public function getReturnObjectClass(): string
    {
        return $this->returnObjectClass;
    }

    public function setReturnObjectCount(string $returnObjectCount): void
    {
        $this->returnObjectCount = $returnObjectCount;
    }

    public function getReturnObjectCount(): string
    {
        return $this->returnObjectCount;
    }

    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public static function findOne(int $id): static
    {
        $instance = new static();
        $instance->setId($id);
        return $instance;
    }

    public function getRawQuery(): string
    {
        $reference = new $this->returnObjectClass;
        $reference();

        $table = $this->getTable();
        $primaryKey = $this->getPrimaryKey();
        $referenceTable = $reference->getTable();

        return "SELECT * from `$table` join `$referenceTable` on `$table`.`$primaryKey` = `$referenceTable`.`{$this->reference}` where `$table`.`$primaryKey` = :id";
    }
}