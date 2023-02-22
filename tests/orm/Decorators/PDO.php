<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\Decorators;

use Attribute;
use PDO as GlobalPDO;

#[Attribute]
class PDO
{
    public GlobalPDO $connection;

    function __construct(
        private string $dsn,
        private string $user,
        private string $pass,
    ) {
        $this->connection = new GlobalPDO($this->dsn, $this->user, $this->pass);
    }
}