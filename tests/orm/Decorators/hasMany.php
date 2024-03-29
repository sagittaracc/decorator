<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\Decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;
use Sagittaracc\PhpPythonDecorator\tests\orm\Attributes\Primary;

#[Attribute]
class hasMany extends PythonDecorator
{
    function __construct(
        private string $objectClass,
        private string $reference,
    ) {}

    public function wrapper($property)
    {
        /**
         * @var \Arutyunyan\Temp\ActiveRecord\ActiveRecord $ar
         */
        $ar = $this->getObject();
        $ar->setReturnObjectClass($this->objectClass);
        $ar->setReturnObjectCount('many');
        $ar->setPrimaryKey((new Primary)->getProperty($ar)->name);
        $ar->setReference($this->reference);
        $ar();

        return (new RawSql)->wrapper($ar);
    }
}