<?php

namespace Core\payment;

interface PaymentInterface
{
    public function createPlan(array $data): bool;
    public function makePayment(array $data): bool;
    public function findClientById(string $id): bool;
}