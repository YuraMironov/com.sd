<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 12:48
 */
require_once ('../Product.php');
class Burger extends Product
{
    public function __construct()
    {
        parent::__construct('Burger', 49.0);
    }
}