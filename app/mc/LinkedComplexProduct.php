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

    public function __construct(ComplexProduct $product, LinkedComplexProduct $nextProduct = null)
    {
        parent::__construct($product, $product->getQuantity());
        $this->nextProduct = $nextProduct;
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
    public function setNextProduct(?LinkedComplexProduct $nextProduct): void
    {
        $this->nextProduct = $nextProduct;
    }
    public function hasNext(): bool
    {
        return $this->getNextProduct() != null;
    }

}