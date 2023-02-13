<?php

namespace Sagittaracc\PhpPythonDecorator\tests\orm\model;

use Sagittaracc\PhpPythonDecorator\tests\orm\ActiveRecord;

class Category extends ActiveRecord
{
    public function getProducts()
    {
        return $this->hasMany(Product::class);
    }
}