<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:57
 */
require_once('McListInterface.php');
require_once('LinkedComplexProduct.php');
require_once('ComplexProduct.php');

class McComplexProductList implements McListInterface
{
    private $head;

    public function __construct()
    {
        $this->head = null;
    }

    public function getHead(): ?LinkedComplexProduct
    {
        return $this->head;
    }

    /**
     * @param LinkedComplexProduct $head
     */
    public function setHead(LinkedComplexProduct $head): void
    {
        $this->head = $head;
    }

    public function get(int $index):?ComplexProduct
    {
        if ($index < 0 || $index >= $this->count()) {
            // TODO: specify exception
            throw new Exception('Index out of bounds');
        }

        $current = $this->getHead();
        for ($i = 0; $i < $index; $i++) {
            $current = $current->getNextProduct();
        }

        return $current;
    }

    public function add(ComplexProduct $product, int $quantity = 1): bool
    {
        if ($product->getQuantity() < 1) {
            $product->setQuantity($quantity);
        }
        if ($this->getHead() == null) {
            $newHead = new LinkedComplexProduct(new ComplexProduct(new Product($product->getName(),
                                                    $product->getCost()), $product->getQuantity()));
            $this->setHead($newHead);
            return true;
        }

        $current = $this->getHead();
        while ($current != null && $current->hasNext()) {
            if ($current->getName() == $product->getName()) {
                break;
            }
            $current = $current->getNextProduct();
        }
        if ($current->getName() == $product->getName()) {
            $current->setQuantity($current->getQuantity() + $product->getQuantity());
            return true;
        }
        $newProduct = new LinkedComplexProduct(new ComplexProduct(new Product($product->getName(),
                                                $product->getCost()), $product->getQuantity()));
        $current->setNextProduct($newProduct);
        return true;
    }

    public function insert(int $index, ComplexProduct $product): bool
    {
        return false;
    }

    public function remove(int $index): bool
    {
        if ($index < 0 || $index >= $this->count()) {
            throw new Exception('Index out of bounds');
        }

        $previous = null;
        $current = $this->getHead();
        for ($i = 0; $i < $index; $i++) {
            $previous = $current;
            $current = $current->getNextProduct();
        }

        if (is_null($previous)) {
            $this->head = $current->getNextProduct();
            return true;
        }

        $previous->setNextProduct($current->getNextProduct());
        return true;
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count(): int
    {
        if (is_null($this->getHead())) {
            return 0;
        }

        $count = 1;
        $current = $this->getHead();
        while ($current->hasNext()) {
            $current = $current->getNextProduct();
            $count++;
        }

        return $count;
    }
}