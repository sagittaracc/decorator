<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\model;

use Sagittaracc\PhpPythonDecorator\tests\decorators\Table;
use Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord;

#[Table('products')]
class Product extends ActiveRecord
{
}