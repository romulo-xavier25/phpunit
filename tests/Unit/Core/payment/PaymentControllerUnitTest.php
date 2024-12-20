<?php

namespace Unit\Core\payment;

use Core\payment\PaymentController;
use Core\payment\PaymentInterface;
use PHPUnit\Framework\TestCase;
use Mockery;
use stdClass;

class PaymentControllerUnitTest extends TestCase
{
    // função onde posso inicializar algo
//    protected function setUp(): void
//    {
//
//    }

    public function testPayment()
    {
        // arrange
        $mockPayment = Mockery::mock(stdClass::class, PaymentInterface::class);
        $mockPayment
                ->shouldReceive('makePayment')
                ->times(1)
                ->andReturn(true);
        $payment = new PaymentController($mockPayment);

        // Act - When / Executamos o código a ser testado
        $response = $payment->execute();

        // Assert - Then / Verificamos se a saída é a esperada
        $this->assertTrue($response);
        Mockery::close();
    }

//    public function tearDown(): void
//    {
//        Mockery::close();
//        parent::tearDown();
//    }
}
