<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\Decorators;

use Attribute;
use PDO;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Query extends PythonDecorator
{
    public function wrapper($ar)
    {
        $rawQuery = (new RawSql)->wrapper($ar);

        return $rawQuery;
    }
}