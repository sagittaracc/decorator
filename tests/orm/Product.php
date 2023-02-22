<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm;

use Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord\ActiveRecord;
use Sagittaracc\PhpPythonDecorator\tests\orm\Decorators\Table;

#[Table('products')]
class Product extends ActiveRecord
{
    public int $id;
    public string $name;
}