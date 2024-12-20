<?php

namespace Unit\Core\orders;

use Core\orders\Product;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProductUnitTest extends TestCase
{
    public function testAttributes()
    {
        $product = new Product(
            id: 1,
            name: 'prodX',
            price: 12,
            total: 10
        );

        $this->assertEquals("prodX", $product->getName());
        $this->assertEquals(12, $product->getPrice());
        $this->assertEquals(120, $product->totalPrice());
        $this->assertEquals(1, $product->getId());
    }

    public function testCalc()
    {
        $product = new Product(
            id: 1,
            name: 'prodX',
            price: 12,
            total: 10
        );
        $this->assertEquals(120, $product->totalPrice());
        $this->assertEquals(132, $product->totalPriceDesconto10());
        $this->assertTrue(true);
    }

    public function testExampleMock()
    {
        $productMock = Mockery::mock(Product::class, [
            5, 'teste mock 1', 25.5, 51
        ]);
        $productMock->shouldReceive('getId')->andReturn('id');

        Mockery::close();
        $this->assertTrue(true);
    }
}