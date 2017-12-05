<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:20
 */
require_once ("Product.php");
require_once ('ComplexProduct.php');
require_once ("LinkedComplexProduct.php");
require_once ("OrderInterface.php");

class Order implements OrderInterface
{
    private $productsList;
    private $orderCost;
    private $gift;
    private $giftName;
    private $minCostToGift;
    public function __construct(ListInterface $list)
    {
        $this->setProductsList($list);
        $this->setOrderCost(0);
        $this->gift = false;
        $this->giftName = 'FreeCoffree';
        $this->minCostToGift = 1000;
    }
    public function getOrderCost(): int
    {
        $this->sumOrderCost();
        return $this->orderCost;
    }
    public function setOrderCost(int $orderCost): void
    {
        $this->orderCost = $orderCost;
    }

    public function addProduct(ComplexProduct $product): bool
    {
        $return = $this->getProductsList()->add($product);
        if ($this->getOrderCost() >= $this->minCostToGift && !$this->gift) {
            $this->addFree();
        }
        return $return;
    }
    public function sumOrderCost(): int
    {
        $this->orderCost = 0;
        $newCost = 0.0;
        for ($i = 0; $i < $this->getProductsList()->count(); $i++) {
            $current = $this->getProductsList()->get($i);
            $newCost = $this->orderCost + $current->getFullCost();
            $this->setOrderCost($newCost);
        }
        return $newCost;
    }

    /**
     * @return ListInterface
     */
    public function getProductsList() : ListInterface
    {
        return $this->productsList;
    }

    /**
     * @param ListInterface $productsList
     */
    public function setProductsList(ListInterface $productsList): void
    {
        $this->productsList = $productsList;
    }

    /**
     * @return array
     */
    public function getSortedProductListByProductCost() : array
    {
        $sorted = iterator_to_array($this->getIterator(), false);
        usort($sorted, "ComplexProduct::compareTo");
        return $sorted;
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     * @return Iterator
     */
    public function getIterator() : Iterator
    {
        return (function() {
            $product = null;
            for ($i = 0; $i < $this->getProductsList()->count(); $i++) {
                $product = $this->getProduct($i);
                if ($product instanceof LinkedComplexProduct) {
                    $product = new ComplexProduct($product, $product->getQuantity());
                }
                yield $product;
            }
        })();
    }

    public function getProduct($index): ComplexProduct
    {
        return $this->getProductsList()->get($index);
    }

    public function remove(int $index): bool
    {
        $this->getProductsList()->remove($index);
        if ($this->gift && $this->getOrderCost() < $this->minCostToGift) {
            $this->deleteFree();
        }
        return true;
    }
    public function addFree():void
    {
        $this->getProductsList()->add(new ComplexProduct(new Gift($this->giftName)));
        $this->gift = true;
    }
    public function deleteFree():void
    {
        $i = 0;
        foreach ($this->getIterator() as $item) {
            if ($item->getName() === $this->giftName) {
                $this->getProductsList()->remove($i);
                $this->gift = false;
            }
            $i++;
        }
    }

}