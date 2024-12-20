<?php

namespace Unit\Core\payment;

use Core\payment\PaymentInterface;

class PagarMe implements PaymentInterface
{

    public function createPlan(array $data): bool
    {
        // TODO: Implement createPlan() method.
    }

    public function makePayment(array $data): bool
    {
        // TODO: Implement makePayment() method.
    }

    public function findClientById(string $id): bool
    {
        // TODO: Implement findClientById() method.
    }
}