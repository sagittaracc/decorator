<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\decorator;

use Attribute;
use PDO;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;
use Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord;

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
            self::$connection = new PDO("mysql:dbname={$this->dbname};host={$this->host}", $this->user, $this->pass);
        }

        return $this->run($func(...$args));
    }

    private function run(ActiveRecord $ar)
    {
        return $ar;
    }
}