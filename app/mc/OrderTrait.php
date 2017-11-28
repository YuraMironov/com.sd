<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 0:19
 */
require_once ("AbstractProduct.php");

trait OrderTrait
{
    public function addProduct(AbstractProduct $product): bool
    {
        return $this->getProductsList()->add($product);
    }

    public function getProduct($index): bool
    {
        return $this->getProductsList()->get($index);
    }

    public function remove(int $index): bool
    {
        return $this->getProductsList()->remove($index);
    }


}