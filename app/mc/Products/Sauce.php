<?php

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 28.11.2017
 * Time: 12:49
 */
require_once ('../Product.php');
class Sauce extends Product
{
    public function __construct()
    {
        parent::__construct('Sauce', 9.0);
    }
}