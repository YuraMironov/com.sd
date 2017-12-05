<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 0:15
 */
require_once ("OrderTrait.php");
interface OrderInterface extends IteratorAggregate
{
    public function __construct(ListInterface $list);
    public function getOrderCost(): int;
    public function setOrderCost(int $orderCost): void;
    public function sumOrderCost(): int;
    public function getProductsList() : ListInterface;
    public function setProductsList(ListInterface $productsList): void;
    public function addProduct(ComplexProduct $product): bool;
    public function getProduct($index): ComplexProduct;
    public function remove(int $index): bool;

}