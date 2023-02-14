<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\model;

use Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord;
use Sagittaracc\PhpPythonDecorator\tests\orm\decorator\Database;
use Sagittaracc\PhpPythonDecorator\tests\orm\decorator\Join;
use Sagittaracc\PhpPythonDecorator\tests\orm\decorator\Table;

#[Database('127.0.0.1', 'test', 'root', '')]
#[Table('categories')]
class Category extends ActiveRecord
{
    #[Join(column: 'product_id', reference: 'id')]
    public function getProducts()
    {
        return $this->hasMany(Product::class);
    }
}