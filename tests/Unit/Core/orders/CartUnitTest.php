<?php

namespace Unit\Core\orders;

use Core\orders\Cart;
use Core\orders\Product;
use PHPUnit\Framework\TestCase;

class CartUnitTest extends TestCase
{
    public function testCart()
    {
        $cart = new Cart();
        $cart->add(product: new Product(
            id: 1,
            name: 'test',
            price: 10,
            total: 100
        ));

        $cart->add(product: new Product(
            id: 2,
            name: 'test 2',
            price: 15,
            total: 150
        ));

        $this->assertCount(2, $cart->getItems());
        $this->assertEquals(25, $cart->totalPrices());
    }

    public function testCartTotal()
    {
        $product1 = new Product(
            id: 1,
            name: 'test',
            price: 10,
            total: 100
        );

        $cart = new Cart();
        $cart->add(product: $product1);
        $cart->add(product: $product1);

        $cart->add(product: new Product(
            id: 2,
            name: 'test 2',
            price: 15,
            total: 150
        ));

        $this->assertCount(2, $cart->getItems());
        $this->assertEquals(35, $cart->totalPrices());
    }

    public function testCartEmpty()
    {
        $cart = new Cart();

        $this->assertCount(0, $cart->getItems());
        $this->assertEquals(0, $cart->totalPrices());
    }
}