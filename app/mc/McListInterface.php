<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 27.11.2017
 * Time: 21:51
 */
require_once ('AbstractProduct.php');

interface McListInterface extends Countable
{
    public function get(int $index):AbstractProduct;
    public function add(AbstractProduct $product): bool;
    public function insert(int $index, AbstractProduct $product): bool;
    public function remove(int $index): bool;

}