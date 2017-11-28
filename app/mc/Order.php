<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 0:15
 */
abstract class Order implements IteratorAggregate
{
    public function __construct(McListInterface $list){}

    public function getOrderCost(): float
    {
    }
    public function setOrderCost(float $orderCost): void
    {
    }
    public function sumOrderCost(): void
    {
    }

    public function getProductsList() : McListInterface{}
    public function setProductsList(McListInterface $productsList): void{}

    use OrderTrait;

}