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
     * @return mixed
     */
    public function getNextProduct(): ComplexProduct
    {
        return $this->nextProduct;
    }

    /**
     * @param mixed $nextProduct
     */
    public function setNextProduct(ComplexProduct $nextProduct): void
    {
        $this->nextProduct = $nextProduct;
    }
}