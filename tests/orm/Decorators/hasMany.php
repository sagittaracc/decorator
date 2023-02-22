<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\Decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class hasMany extends PythonDecorator
{
    function __construct(
        private string $objectClass,
        private string $id,
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
        $ar->setPrimaryKey($this->id);
        $ar->setReference($this->reference);
        $ar();

        return (new Query)->wrapper(fn() => $ar);
    }
}