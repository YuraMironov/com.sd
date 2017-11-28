<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:20
 */
require_once ('AbstractProduct.php');
require_once ("Product.php");
require_once ('ComplexProduct.php');
require_once ("McListInterface.php");
require_once ("Order.php");

class McOrder extends Order
{
    private $productsList;
    private $orderCost;
    public function __construct(McListInterface $list)
    {
        $this->setProductsList($list);
        $this->setOrderCost(0);
    }

    /**
     * @return float
     */
    public function getOrderCost(): float
    {
        $this->sumOrderCost();
        return $this->orderCost;
    }
    /**
     * @param float $orderCost
     */
    public function setOrderCost(float $orderCost): void
    {
        $this->orderCost = $orderCost;
    }
    public function sumOrderCost(): void
    {
        $current = $this->getProductsList()->getHead();
        while (!is_null($current)){
            $newCost = $this->getOrderCost() + $current->getQuantity() * $current->getCost();
            $this->setOrderCost($newCost);
            $current = $current->getNextProduct();
        }
    }

    /**
     * @return McListInterface
     */
    public function getProductsList() : McListInterface
    {
        return $this->productsList;
    }

    /**
     * @param McListInterface $productsList
     */
    public function setProductsList(McListInterface $productsList): void
    {
        $this->productsList = $productsList;
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */

    public function getIterator() : Iterator
    {
        foreach ($this->productsList as $value) {
            yield $value;
        }
    }
}