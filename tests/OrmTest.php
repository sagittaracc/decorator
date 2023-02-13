<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\orm\model\Category;
use Sagittaracc\PhpPythonDecorator\tests\orm\model\Product;

final class OrmTest extends TestCase
{
    public function testOrm(): void
    {
        $products = Category::findOne(1)->_getProducts();

        $this->assertInstanceOf(Category::class, $products['self']);
        $this->assertSame('categories', $products['self']->table);
        $this->assertSame(1, $products['self']->getId());
        $this->assertSame(Product::class, $products['return']);
        $this->assertSame('many', $products['count']);

        $this->assertSame([
            ['column' => 'product_id', 'referencedTable' => 'products', 'referencedColumn' => 'id']
        ], $products['self']->getJoins());
    }
}