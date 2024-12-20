<?php

namespace Core\orders;

class Product
{

    public function __construct(
        private int $id,
        protected string $name,
        protected float $price,
        protected int $total
    )
    {
    }

    public function totalPrice(): float
    {
        return $this->price * $this->total;
    }

    public function totalPriceDesconto10(): float
    {
        $valorTotal = $this->price * $this->total;
        return $valorTotal + ($valorTotal * 0.1);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

}