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

    public function wrapper($func, $args)
    {
        $options = $func(...$args);
        $referencedModel = new $options['return'];
        $referencedModel();

        /**
         * @var \Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord $query
         */
        $query = $this->getObject();
        $query->addJoin($this->column, $referencedModel->table, $this->reference);

        return $options;
    }
}