<?php

namespace Core\orders;

class Customer
{
    public function __construct(
        protected string $name
    )
    {}

    public function changeName(
        string $name
    )
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

}