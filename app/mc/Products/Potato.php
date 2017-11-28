<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 12:48
 */
require_once ('../Product.php');
class Potato extends Product
{
    public function __construct()
    {
        parent::__construct('Potato', 39.0);
    }
}