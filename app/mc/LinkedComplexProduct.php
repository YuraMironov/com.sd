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

    /**
     * @return LinkedComplexProduct
     */
    public function getNextProduct(): ComplexProduct
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