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
        if ($quantity <= 0) {
            $quantity = 1;
        }
        $this->quantity = $quantity;
    }

    public function getFullCost(): int
    {
        return $this->getCost() * $this->getQuantity();
    }

    public static function compareTo(ComplexProduct $first = null, ComplexProduct $second = null): int
    {
        if ($first->getQuantity() === $second->getQuantity()) {
            return 0;
        }
        if ($first->getQuantity() > $second->getQuantity()) {
            return -1;
        } else {
            return 1;
        }
    }

}