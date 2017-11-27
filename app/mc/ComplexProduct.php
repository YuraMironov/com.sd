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

    public function __construct(string $name, float $cost, int $quantity = null)
    {
        parent::__construct($name, $cost);
        if (!is_null($quantity)) {
            $this->setQuantity($quantity);
        }
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

}