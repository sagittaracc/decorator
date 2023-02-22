<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\Decorators;

use Attribute;
use PDO;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Query extends PythonDecorator
{
    public function wrapper($classObject)
    {
        /**
         * @var \Arutyunyan\Temp\ActiveRecord\ActiveRecord $ar
         */
        $ar = $classObject();

        $rawQuery = (new RawSql)->wrapper(fn() => $ar);

        $dbh = $ar->getConnection();
        $sth = $dbh->prepare($rawQuery);
        $sth->execute([':id' => $ar->getId()]);

        return $sth->fetchAll(PDO::FETCH_CLASS, $ar->getReturnObjectClass());
    }
}