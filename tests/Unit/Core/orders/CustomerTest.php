<?php

namespace Unit\Core\orders;

use Core\orders\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testAttributes()
    {
        $customer = new Customer(
            name: 'John Doe',
        );
        $this->assertEquals('John Doe', $customer->getName());

        $customer->changeName(name: 'John Doe New');
        $this->assertEquals('John Doe New', $customer->getName());

        $this->assertTrue(true);
    }
}