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
require_once ("LinkedComplexProduct.php");
require_once ("Order.php");

class McOrder extends Order
{
    private $productsList;
    private $orderCost;
    public function __construct(McListInterface $list)
    {
        $this->setProductsList($list);
        $this->setOrderCost(0.0);
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
        for ($i = 0; $i < $this->getProductsList()->count(); $i++) {
            $current = $this->getProductsList()->get($i);
            $newCost = $this->getOrderCost() + $current->getFullCost();
            $this->setOrderCost($newCost);
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
    public function getSortedProductListByProductCost() : array
    {
        $sorted = iterator_to_array($this->getIterator(), false);
        usort($sorted, "ComplexProduct::compareTo");
        return $sorted;
    }
    public function getIterator() : Iterator
    {
        return (function() {
            $product = null;
            for ($i = 0; $i < $this->getProductsList()->count(); $i++) {
                $product = $this->getProduct($i);
                if ($product instanceof LinkedComplexProduct) {
                    $product = new ComplexProduct(new Product($product->getName(), $product->getCost()), $product->getQuantity());
                }
                yield $product;
            }
        })();
    }
}