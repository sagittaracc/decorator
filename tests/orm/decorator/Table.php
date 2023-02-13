<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\decorator;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Table extends PythonDecorator
{
    function __construct(
        private string $name
    ) {}

    public function wrapper($func, $args)
    {
        /**
         * @var \Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord $query
         */
        $query = $this->getObject();
        $query->table = $this->name;

        return $func(...$args);
    }
}