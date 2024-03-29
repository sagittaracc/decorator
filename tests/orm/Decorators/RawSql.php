<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\Decorators;

use Attribute;
use Sagittaracc\PhpPythonDecorator\PythonDecorator;

#[Attribute]
class RawSql extends PythonDecorator
{
    public function wrapper($ar)
    {
        /**
         * @var ar Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord\ActiveRecord
         */
        return (new $ar->builderClass)->wrapper($ar);
    }
}