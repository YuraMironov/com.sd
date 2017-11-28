<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:57
 */
require_once('McListInterface.php');
require_once('LinkedComplexProduct.php');
require_once ('ComplexProduct.php');

class McComplexProductList implements McListInterface
{
    private $head;

    /**
     * @return LinkedComplexProduct
     */
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
        if ($this->getHead() == null) {
            $newHead = new LinkedComplexProduct($product->getName(), $product->getCost(), $quantity);
            $this->setHead($newHead);
            return true;
        } else {

            $current = $this->getHead();
            while (!is_null($current->getNextProduct()) || $current->getName() != $product->getName()) {
                $current = $current->getNextProduct();
            }
            if ($current->getName() == $product->getName()) {
                $current->setQuantity($current->getQuantity() + $quantity);
                return true;
            } else {
                $newProduct = new LinkedComplexProduct($product->getName(), $product->getCost(), $quantity);
                $current->setNextProduct($newProduct);
            }

            return true;
        }
    }

    public function insert(int $index, ComplexProduct $product): bool
    {
        return false;
    }

    public function remove(int $index): bool
    {
        if ($index < 0 || $index >= $this->count()) {
            // TODO: specify exception
            throw new Exception('Index out of bounds');
        }

        $previous = null;
        $current = $this->getHead();
        for ($i = 0; $i < $index; $i++) {
            $previous = $current;
            $current = $current->getNextProduct();
        }

        if (is_null($previous)) {
            $this->setHead(null);
            return false;
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
    public function count():int
    {
        if (is_null($this->getHead())) {
            return 0;
        }

        $count = 1;
        $current = $this->getHead();
        while (!is_null($current->getNextProduct())) {
            $current = $current->getNextProduct();
            $count++;
        }

        return $count;
    }
}