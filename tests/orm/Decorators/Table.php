<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\Decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Table extends PythonDecorator
{
    function __construct(
        private string $table,
    ) {}

    public function wrapper($class)
    {
        $classObject = $class();
        $classObject->setTable($this->table);
        return $classObject;
    }
}