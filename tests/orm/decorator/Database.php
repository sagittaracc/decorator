<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\decorator;

use Attribute;
use PDO;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Database extends PythonDecorator
{
    private static null|PDO $connection = null;

    function __construct(
        private string $host,
        private string $dbname,
        private string $user,
        private string $pass
    ) {}

    public function wrapper($func, $args)
    {
        if (self::$connection === null) {
            // self::$connection = new PDO("mysql:dbname={$this->dbname};host={$this->host}", $this->user, $this->pass);
        }

        $ar = (new Query('mysql'))->wrapper($func, $args);

        // $sth = self::$connection->prepare($ar->rawQuery);
        // $sth->execute();
        // $rows = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $ar;
    }
}