<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\decorator;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class Join extends PythonDecorator
{
    function __construct(
        private string $column,
        private string $reference
    ) {}

    public function wrapper($func)
    {
        /**
         * @var \Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord $ar
         */
        $ar = $func();
        $referencedModel = new $ar->returnObjectClass;
        $referencedModel();

        $ar->addJoin($this->column, $referencedModel->table, $this->reference);

        return $ar;
    }
}