<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\decorator;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;
use Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord;

#[Attribute]
class Query extends PythonDecorator
{
    function __construct(
        private string $dbms
    ) {}

    public function wrapper($func, $args)
    {
        /**
         * @var \Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord $query
         */
        $ar = $func(...$args);
        
        $ar->rawQuery =
            $this->buildSelect($ar) .
            $this->buildFrom($ar) .
            $this->buildJoin($ar) .
            $this->buildWhere($ar);

        return $ar;
    }

    private function buildSelect(ActiveRecord $ar)
    {
        return 'select * ';
    }

    private function buildFrom(ActiveRecord $ar)
    {
        return "from `$ar->table` ";
    }

    private function buildJoin(ActiveRecord $ar)
    {
        $joinString = '';
        $table = $ar->table;

        foreach ($ar->getJoins() as $join) {
            $column = $join['column'];
            $referencedTable = $join['referencedTable'];
            $referencedColumn = $join['referencedColumn'];

            $joinString .= "join `$referencedTable` on `$table`.`$column` = `$referencedTable`.`$referencedColumn` ";
        }

        return $joinString;
    }

    private function buildWhere(ActiveRecord $ar)
    {
        return "where `$ar->table`.`$ar->primaryKey` = {$ar->getId()}";
    }
}