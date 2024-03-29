<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\Decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class RawSql extends PythonDecorator
{
    public function wrapper($ar)
    {
        $returnObject = $ar->getReturnObjectClass();
        $reference = new $returnObject;
        $reference();

        $table = $ar->getTable();
        $primaryKey = $ar->getPrimaryKey();
        $referenceTable = $reference->getTable();
        $reference = $ar->getReference();

        return "SELECT * from `$table` join `$referenceTable` on `$table`.`$primaryKey` = `$referenceTable`.`$reference` where `$table`.`$primaryKey` = :id";
    }
}