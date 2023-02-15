<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\decorator;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Table extends PythonDecorator
{
    function __construct(
        private string $name,
        private string $primaryKey = 'id'
    ) {}

    public function wrapper($func, $args)
    {
        /**
         * @var \Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord $ar
         */
        $ar = $func(...$args);
        $ar->table = $this->name;
        $ar->primaryKey = $this->primaryKey;

        return $ar;
    }
}