<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\orm\Category;

final class OrmTest extends TestCase
{
    public function testTable(): void
    {
        $category = new Category();
        $category();
        $this->assertSame('categories', $category->getTable());
    }

    public function testHasMany(): void
    {
        $category = Category::findOne(1);
        $query = $category->_products;
        $this->assertSame('SELECT * from `categories` join `products` on `categories`.`id` = `products`.`category_id` where `categories`.`id` = :id', $query);
        $this->assertSame(1, $category->getId());
    }
}