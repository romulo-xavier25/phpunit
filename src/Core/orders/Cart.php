<?php

namespace Core\orders;

class Cart
{

    /**
     * @var Product[]
     */
    private array $items = [];

    public function __construct()
    {

    }

    public function add(Product $product)
    {
        $qtd = isset($this->items[$product->getId()]) ? $this->items[$product->getId()]['qtd'] + 1 : 1;

        $this->items[$product->getId()] = [
            'qtd'     => $qtd,
            'product' => $product
        ];
//        array_push($this->items, $product);
    }

    public function totalPrices(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $product = $item['product'];
            $total += $product->getPrice() * $item['qtd'];
        }
        return $total;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

}