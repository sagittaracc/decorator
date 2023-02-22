<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\model;

use Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord;
use Sagittaracc\PhpPythonDecorator\tests\orm\decorator\Database;
use Sagittaracc\PhpPythonDecorator\tests\orm\decorator\Join;
use Sagittaracc\PhpPythonDecorator\tests\orm\decorator\Table;

class Category extends ActiveRecord
{
    public int $id;
    public string $title;

    #[Database('127.0.0.1', 'test', 'root', '')]
    #[Table('categories')]
    #[Join(column: 'id', reference: 'category_id')]
    public function getProducts()
    {
        return $this->hasMany(Product::class);
    }
}