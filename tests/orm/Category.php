<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm;

use Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord\ActiveRecord;
use Sagittaracc\PhpPythonDecorator\tests\orm\Decorators\hasMany;
use Sagittaracc\PhpPythonDecorator\tests\orm\Decorators\Table;

#[Table('categories')]
class Category extends ActiveRecord
{
    // TODO: #[Primary]
    public int $id;
    public string $title;

    // #[hasMany(Product::class, reference: 'category_id')]
    #[hasMany(Product::class, id: 'id', reference: 'category_id')]
    public $products;
}