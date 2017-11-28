<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:46
 */
require_once("Product.php");

class ComplexProduct extends Product
{
    private $quantity;

    public function __construct(Product $product, int $quantity = 1)
    {
        parent::__construct($product->getName(), $product->getCost());
        $this->setQuantity($quantity);
    }

    /**
     * @return mixed
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getFullCost():float
    {
        return $this->getCost() * $this->getQuantity();
    }

}