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

        $self = $products['self'];
        $return = $products['return'];
        $count = $products['count'];

        $this->assertInstanceOf(Category::class, $self);
        $this->assertSame('categories', $self->table);
        $this->assertSame(1, $self->getId());
        $this->assertSame([
            ['column' => 'product_id', 'referencedTable' => 'products', 'referencedColumn' => 'id']
        ], $self->getJoins());

        $this->assertSame('many', $count);
        $this->assertSame(Product::class, $return);

    }
}