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
    public function get(int $index):?ComplexProduct;
    public function add(ComplexProduct $product): bool;
    public function insert(int $index, ComplexProduct $product): bool;
    public function remove(int $index): bool;

}