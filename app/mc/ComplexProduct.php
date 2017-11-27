<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:46
 */
require_once ("Product.php");
class ComplexProduct extends Product
{
    private $quantity;

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
}