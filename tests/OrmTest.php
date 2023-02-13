<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\orm\model\Category;
use Sagittaracc\PhpPythonDecorator\tests\orm\model\Product;

final class OrmTest extends TestCase
{
    public function testOrm(): void
    {
        $ar = Category::findOne(1)->_getProducts();

        $this->assertInstanceOf(Category::class, $ar);
        $this->assertSame('categories', $ar->table);
        $this->assertSame(1, $ar->getId());
        $this->assertSame([
            ['column' => 'product_id', 'referencedTable' => 'products', 'referencedColumn' => 'id']
        ], $ar->getJoins());

        $this->assertSame(Product::class, $ar->returnObjectClass);
        $this->assertSame('many', $ar->returnObjectCount);

    }
}