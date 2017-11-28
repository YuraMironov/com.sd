<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:59
 */
require_once ('ComplexProduct.php');

class LinkedComplexProduct extends ComplexProduct
{
    private $nextProduct;

    public function __construct(string $name, float $cost, int $quantity = null)
    {
        parent::__construct($name, $cost, $quantity);
        $this->nextProduct = null;
    }

    /**
     * @return LinkedComplexProduct
     */
    public function getNextProduct(): ?LinkedComplexProduct
    {
        return $this->nextProduct;
    }

    /**
     * @param LinkedComplexProduct $nextProduct
     */
    public function setNextProduct(LinkedComplexProduct $nextProduct): void
    {
        $this->nextProduct = $nextProduct;
    }

}