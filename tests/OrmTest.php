<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sagittaracc\PhpPythonDecorator\tests\orm\Category;

final class OrmTest extends TestCase
{
    public function testOrm(): void
    {
        /**
         * Orm example
         */
        $category = Category::findOne(1);
        $products = $category->_products;

        $firstProduct = $products[0];
        $secondProduct = $products[1];

        $this->assertSame(1, $firstProduct->id);
        $this->assertSame('computer', $firstProduct->name);

        $this->assertSame(2, $secondProduct->id);
        $this->assertSame('phone', $secondProduct->name);
        
        $this->assertNull(null);
    }
}